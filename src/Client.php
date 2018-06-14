<?php namespace MyENA\RGW;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request as PSR7Request;
use GuzzleHttp\Psr7\Uri as PSR7Uri;
use GuzzleHttp\RequestOptions;
use MyENA\RGW\Error\ApiError;
use MyENA\RGW\Error\TransportError;
use Psr\Http\Message\RequestInterface;

/**
 * Class Client
 * @package MyENA\RGW
 */
class Client {
    /** @var \MyENA\RGW\Config */
    private $config;
    /** @var \MyENA\RGW\Signature */
    private $signer;

    /** @var string */
    private $address;

    /** @var array */
    private static $requestOptions = [
        RequestOptions::HTTP_ERRORS     => false,
        RequestOptions::DECODE_CONTENT  => false,
        RequestOptions::ALLOW_REDIRECTS => true,
    ];

    /**
     * Client constructor.
     * @param \MyENA\RGW\Config    $config
     * @param \MyENA\RGW\Signature $signer
     */
    public function __construct(Config $config, Signature $signer) {
        $this->config = $config;
        $this->signer = $signer;
    }

    /**
     * @return \MyENA\RGW\Config
     */
    public function getConfig(): Config {
        return $this->config;
    }

    /**
     * @return \MyENA\RGW\Chain\BucketRootLink
     */
    public function Bucket(): Chain\BucketRootLink {
        return Chain\BucketRootLink::new(null, [], $this, $this->config->getLogger());
    }

    /**
     * @return \MyENA\RGW\Chain\MetadataRootLink
     */
    public function Metadata(): Chain\MetadataRootLink {
        return Chain\MetadataRootLink::new(null, [], $this, $this->config->getLogger());
    }

    /**
     * @return \MyENA\RGW\Chain\UserRootLink
     */
    public function User(): Chain\UserRootLink {
        return Chain\UserRootLink::new(null, [], $this, $this->config->getLogger());
    }

    /**
     * @param \MyENA\RGW\Request $request
     * @return array(
     * @type \Psr\Http\Message\ResponseInterface|null
     * @type \MyENA\RGW\Error|null
     * )
     */
    public function do(Request $request): array {
        $psrRequest = $this->compilePSR7($request);
        if (!$this->config->isSilent()) {
            $this->config->getLogger()->debug(
                "Executing {$psrRequest->getMethod()} {$psrRequest->getUri()->getPath()}"
            );
        }

        try {
            $resp = $this->config->getHttpClient()->send($psrRequest, self::$requestOptions);
        } catch (GuzzleException $e) {
            if (!$this->config->isSilent()) {
                $this->config->getLogger()->error("Query returned {$e->getCode()}: {$e->getMessage()}");
            }
            return [null, new TransportError($e->getCode(), $e->getMessage())];
        }

        if (!$this->config->isSilent()) {
            $this->config->getLogger()->debug("Query returned {$resp->getStatusCode()}: {$resp->getReasonPhrase()}");
        }

        if (400 <= $resp->getStatusCode()) {
            return [null, ApiError::fromResponse($resp)];
        }

        return [$resp, null];
    }

    /**
     * @return string
     */
    private function serviceAddress(): string {
        if (!isset($this->address)) {
            $this->address = sprintf(
                'https://%s/%s',
                $this->config->getAddress(),
                $this->config->getAdminPath()
            );
        }
        return $this->address;
    }

    /**
     * @param \MyENA\RGW\Request $r
     * @return \Psr\Http\Message\RequestInterface
     */
    private function compilePSR7(Request $r): RequestInterface {
        $uri = new PSR7Uri("{$this->serviceAddress()}{$r->uri()}");
        if (0 < (count($r->parameters()))) {
            $params = [];
            foreach ($r->parameters() as $k => $v) {
                if (null === $v) {
                    $params[] = $k;
                } else {
                    $params[] = "{$k}={$v}";
                }
            }
            $uri = $uri->withQuery(implode('&', $params));
        }
        $psrRequest = new PSR7Request($r->method(), $uri, $r->headers(), $r->body());
        if ($r->authenticated()) {
            $psrRequest = $this->signer->sign($this->config, $psrRequest);
        }
        return $psrRequest;
    }
}