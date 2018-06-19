<?php declare(strict_types=1);

namespace MyENA\RGW;


use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Class Config
 *
 * @package MyENA\RGW
 */
class Config implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    const DEFAULT_CLIENT_TIMEOUT  = 10;
    const DEFAULT_SKIP_SSL_VERIFY = false;

    /** @var int */
    private $clientTimeout = self::DEFAULT_CLIENT_TIMEOUT;
    /** @var string */
    private $address = '';
    /** @var string */
    private $adminPath = '';
    /** @var string */
    private $apiKey = '';
    /** @var string */
    private $apiSecret = '';

    /** @var \GuzzleHttp\ClientInterface */
    private $httpClient;

    /** @var bool */
    private $silent = false;

    /**
     * Config constructor.
     *
     * @param array $config
     * @param \GuzzleHttp\ClientInterface|null $httpClient
     * @param \Psr\Log\LoggerInterface|null $logger
     */
    public function __construct(array $config = [], ClientInterface $httpClient = null, LoggerInterface $logger = null)
    {
        if (null === $logger) {
            $logger = new NullLogger();
        }
        $this->setLogger($logger);
        foreach ($config as $k => $v) {
            $k = sanitizeName($k, '_', true);
            if ('httpClient' === $k) {
                $httpClient = $v;
            } else {
                $this->{'set' . ucfirst($k)}($v);
            }
        }
        if (null === $httpClient) {
            $httpClient = new GuzzleClient();
        }
        $this->httpClient = $httpClient;
        if (!($this->httpClient instanceof ClientInterface)) {
            throw new \InvalidArgumentException(sprintf('httpClient must implement %s', ClientInterface::class));
        }
    }

    /**
     * @return array
     */
    public static function getEnvironmentConfig(): array
    {
        $ret = [];
        foreach ([
                     ENV_RGW_API_HTTP_ADDR  => tryGetEnvParam(ENV_RGW_API_HTTP_ADDR, '127.0.0.1'),
                     ENV_RGW_API_ADMIN_PATH => tryGetEnvParam(ENV_RGW_API_ADMIN_PATH, 'admin'),
                     ENV_RGW_API_KEY        => tryGetEnvParam(ENV_RGW_API_KEY),
                     ENV_RGW_API_SECRET     => tryGetEnvParam(ENV_RGW_API_SECRET),
                     ENV_RGW_LOG_SILENT     => tryGetEnvParam(ENV_RGW_LOG_SILENT, '0'),
                 ] as $k => $v) {
            if ('' !== $v) {
                $ret[$k] = $v;
            }
        }
        return $ret;
    }

    /**
     * @param \GuzzleHttp\Client|null $client
     * @return \MyENA\RGW\Config
     */
    public static function defaultConfig(?GuzzleClient $client = null, ?LoggerInterface $logger = null): Config
    {
        $conf = [];
        foreach (self::getEnvironmentConfig() as $k => $v) {
            if (ENV_RGW_API_HTTP_ADDR === $k) {
                $conf['address'] = $v;
            } elseif (ENV_RGW_API_ADMIN_PATH === $k) {
                $conf['adminPath'] = $v;
            } elseif (ENV_RGW_API_KEY === $k) {
                $conf['apiKey'] = $v;
            } elseif (ENV_RGW_API_SECRET === $k) {
                $conf['apiSecret'] = $v;
            } elseif (ENV_RGW_LOG_SILENT === $k) {
                $conf['silent'] = (bool)$v;
            }
        }
        return new static($conf, $client, $logger);
    }

    /**
     * @return int
     */
    public function getClientTimeout(): int
    {
        return $this->clientTimeout;
    }

    /**
     * @param int $clientTimeout
     */
    public function setClientTimeout(int $clientTimeout): void
    {
        $this->clientTimeout = $clientTimeout;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        $this->address = trim($address, " \t\n\r\0\x0B/");
    }

    /**
     * @return string
     */
    public function getAdminPath(): string
    {
        return $this->adminPath;
    }

    /**
     * @param string $adminPath
     */
    public function setAdminPath(string $adminPath): void
    {
        $this->adminPath = trim($adminPath, " \t\n\r\0\x0B/");
    }

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getApiSecret(): string
    {
        return $this->apiSecret;
    }

    /**
     * @param string $apiSecret
     */
    public function setApiSecret(string $apiSecret): void
    {
        $this->apiSecret = $apiSecret;
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        return $this->httpClient;
    }

    /**
     * @return bool
     */
    public function isSilent(): bool
    {
        return $this->silent;
    }

    /**
     * @param bool $silent
     */
    public function setSilent(bool $silent): void
    {
        $this->silent = $silent;
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }
}