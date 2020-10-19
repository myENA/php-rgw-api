<?php declare(strict_types=1);

namespace MyENA\RGW\Signature;

use MyENA\RGW\Config;
use MyENA\RGW\Signature;
use Psr\Http\Message\RequestInterface;
use function MyENA\RGW\isS3VirtualHostedStyle;

/**
 * Class V2Signature
 * @package MyENA\RGW\Signature
 */
class V2Signature implements Signature
{
    /**
     * @param \MyENA\RGW\Config $config
     * @param \Psr\Http\Message\RequestInterface $request
     * @return \Psr\Http\Message\RequestInterface
     */
    public function sign(Config $config, RequestInterface $request): RequestInterface
    {
        if (!$config->isSilent()) {
            $config->getLogger()->debug(sprintf(
                'Signing request "%s %s"',
                $request->getMethod(),
                $request->getRequestTarget()
            ));
        }

        return $request->withHeader('Date', gmdate(RGW_AUTH_DATETIME_FORMAT))
            ->withHeader('Authorization',
                sprintf('AWS %s:%s',
                    $config->getApiKey(),
                    $this->signString($this->stringToSignS3($request), $config->getApiSecret())));
    }

    /**
     * @param string $string
     * @param string $secret
     * @return string
     */
    private function signString(string $string, string $secret): string
    {
        return base64_encode(hash_hmac('sha1', $string, $secret, true));
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @return string
     */
    private function stringToSignS3(RequestInterface $request): string
    {
        return $this->methodLine($request) .
            $this->bodyHashLine($request) .
            $this->contentTypeLine($request) .
            $this->dateLine($request) .
            $this->canonicalAmazonHeadersLines($request) .
            $this->canonicalResourceS3Line($request);
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @return string
     */
    private function methodLine(RequestInterface $request): string
    {
        return $request->getMethod() . "\n";
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @return string
     */
    private function bodyHashLine(RequestInterface $request): string
    {
        if ('' !== ($md5 = (string)$request->getHeaderLine('Content-MD5'))) {
            return "{$md5}\n";
        }

        $body = $request->getBody();
        if (null === $body || 0 === (int)$body->getSize()) {
            return "\n";
        }

        $body->rewind();
        $md5 = md5((string)$body->getContents());
        $body->rewind();

        return "{$md5}\n";
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @return string
     */
    private function contentTypeLine(RequestInterface $request): string
    {
        $t = (string)$request->getHeaderLine('Content-Type');
        return "{$t}\n";
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @return string
     */
    private function dateLine(RequestInterface $request): string
    {
        $date = (string)$request->getHeaderLine('Date');
        if ('' === $date) {
            $date = gmdate(RGW_AUTH_DATETIME_FORMAT);
        }
        return "{$date}\n";
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @return string
     */
    private function canonicalAmazonHeadersLines(RequestInterface $request): string
    {
        $headers = [];
        foreach ($request->getHeaders() as $name => $_) {
            $standardized = strtolower(trim($name));
            if (0 === strpos($standardized, 'x-amz')) {
                $amzHeaders[$standardized] = sprintf(
                    '%s:%s',
                    $standardized,
                    str_replace("\n", " ", trim((string)$request->getHeaderLine($name)))
                );
            }
        }
        if (0 === count($headers)) {
            return '';
        }
        ksort($headers, SORT_STRING);
        return implode("\n", $headers) . "\n";
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @return string
     */
    private function canonicalResourceS3Line(RequestInterface $request): string
    {
        $buff = '';

        if (isS3VirtualHostedStyle($request)) {
            $bucketName = explode('.', $request->getUri()->getHost(), 2)[0];
            $buff .= "/{$bucketName}";
        }

        $buff .= $request->getUri()->getPath();

        $query = $request->getUri()->getQuery();

        foreach (RGW_SUBRESOURCE_S3 as $subres) {
            if (0 === strpos($query, $subres)) {
                $buff .= "?{$subres}";
            }
        }

        return $buff;
    }
}