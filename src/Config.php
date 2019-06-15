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

    const FIELD_CLIENT_TIMEOUT = 'clientTimeout';
    const FIELD_ADDRESS        = 'address';
    const FIELD_ADMIN_PATH     = 'adminPath';
    const FIELD_API_KEY        = 'apiKey';
    const FIELD_API_SECRET     = 'apiSecret';
    const FIELD_NO_SSL         = 'noSSL';
    const FIELD_HTTP_CLIENT    = 'httpClient';
    const FIELD_SILENT         = 'silent';

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
    /** @var bool */
    private $noSSL = false;

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
        // add env values
        $config += self::getConfigFromEnvironment();
        // parse conf
        foreach ($config as $rawK => $v) {
            $k = sanitizeName($rawK, '_', true);
            if (self::FIELD_CLIENT_TIMEOUT === $k) {
                $this->setClientTimeout($config[self::FIELD_CLIENT_TIMEOUT]);
            } elseif (self::FIELD_ADDRESS === $k) {
                $this->setAddress($config[self::FIELD_ADDRESS]);
            } elseif (self::FIELD_ADMIN_PATH === $k) {
                $this->setAdminPath($config[self::FIELD_ADMIN_PATH]);
            } elseif (self::FIELD_API_KEY === $k) {
                $this->setApiKey($config[self::FIELD_API_KEY]);
            } elseif (self::FIELD_API_SECRET === $k) {
                $this->setApiSecret($config[self::FIELD_API_SECRET]);
            } elseif (self::FIELD_NO_SSL === $k) {
                $this->setNoSSL($config[self::FIELD_NO_SSL]);
            } elseif (self::FIELD_HTTP_CLIENT === $k) {
                $httpClient = $config[self::FIELD_HTTP_CLIENT];
            } elseif (self::FIELD_SILENT === $k) {
                $this->setSilent($config[self::FIELD_SILENT]);
            } else {
                throw new \OutOfBoundsException(sprintf(
                    'Unknown configuration key "%s" seen.',
                    $rawK
                ));
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
                     ENV_RGW_API_NO_SSL     => tryGetBoolEnvParam(ENV_RGW_API_NO_SSL, '0'),
                     ENV_RGW_API_ADMIN_PATH => tryGetEnvParam(ENV_RGW_API_ADMIN_PATH, 'admin'),
                     ENV_RGW_API_KEY        => tryGetEnvParam(ENV_RGW_API_KEY),
                     ENV_RGW_API_SECRET     => tryGetEnvParam(ENV_RGW_API_SECRET),
                     ENV_RGW_LOG_SILENT     => tryGetBoolEnvParam(ENV_RGW_LOG_SILENT, '0'),
                 ] as $k => $v) {
            if ('' !== $v) {
                $ret[$k] = $v;
            }
        }
        return $ret;
    }

    /**
     * @return array
     */
    public static function getConfigFromEnvironment(): array
    {
        $conf = [];
        foreach (self::getEnvironmentConfig() as $k => $v) {
            if (ENV_RGW_API_HTTP_ADDR === $k) {
                $conf[self::FIELD_ADDRESS] = $v;
            } elseif (ENV_RGW_API_NO_SSL === $k) {
                $conf[self::FIELD_NO_SSL] = $v;
            } elseif (ENV_RGW_API_ADMIN_PATH === $k) {
                $conf[self::FIELD_ADMIN_PATH] = $v;
            } elseif (ENV_RGW_API_KEY === $k) {
                $conf[self::FIELD_API_KEY] = $v;
            } elseif (ENV_RGW_API_SECRET === $k) {
                $conf[self::FIELD_API_SECRET] = $v;
            } elseif (ENV_RGW_LOG_SILENT === $k) {
                $conf[self::FIELD_SILENT] = $v;
            }
        }
        return $conf;
    }

    /**
     * @param \GuzzleHttp\Client|null $client
     * @param null|\Psr\Log\LoggerInterface $logger
     * @return \MyENA\RGW\Config
     */
    public static function defaultConfig(?GuzzleClient $client = null, ?LoggerInterface $logger = null): Config
    {
        return new static(self::getConfigFromEnvironment(), $client, $logger);
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
     * @return bool
     */
    public function isNoSSL(): bool
    {
        return $this->noSSL;
    }

    /**
     * @param bool $noSSL
     */
    public function setNoSSL(bool $noSSL): void
    {
        $this->noSSL = $noSSL;
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