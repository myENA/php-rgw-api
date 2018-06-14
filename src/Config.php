<?php namespace MyENA\RGW;


use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Class Config
 * @package myENA\RGW
 */
class Config implements LoggerAwareInterface {
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
    private $zoneName = '';
    /** @var string */
    private $apiKey = '';
    /** @var string */
    private $apiSecret = '';
    /** @var string */
    private $securityToken = '';
    /** @var int */
    private $expiration = 0;

    /** @var \GuzzleHttp\ClientInterface */
    private $httpClient;

    /** @var bool */
    private $silent = false;

    /**
     * Config constructor.
     * @param array                            $opts
     * @param \GuzzleHttp\ClientInterface|null $httpClient
     * @param \Psr\Log\LoggerInterface|null    $logger
     */
    public function __construct(array $opts = [], ClientInterface $httpClient = null, LoggerInterface $logger = null) {
        if (null === $logger) {
            $logger = new NullLogger();
        }
        $this->setLogger($logger);
        foreach ($opts as $k => $v) {
            $k = sanitizeName($k, '_', true);
            if ('httpClient' === $k) {
                $httpClient = $v;
            } else {
                $this->{'set'.ucfirst($k)}($v);
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
     * @return int
     */
    public function getClientTimeout(): int {
        return $this->clientTimeout;
    }

    /**
     * @param int $clientTimeout
     */
    public function setClientTimeout(int $clientTimeout): void {
        $this->clientTimeout = $clientTimeout;
    }

    /**
     * @return string
     */
    public function getAddress(): string {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress(string $address): void {
        $this->address = trim($address, " \t\n\r\0\x0B/");
    }

    /**
     * @return string
     */
    public function getAdminPath(): string {
        return $this->adminPath;
    }

    /**
     * @param string $adminPath
     */
    public function setAdminPath(string $adminPath): void {
        $this->adminPath = trim($adminPath, " \t\n\r\0\x0B/");
    }

    /**
     * @return string
     */
    public function getZoneName(): string {
        return $this->zoneName;
    }

    /**
     * @param string $zoneName
     */
    public function setZoneName(string $zoneName): void {
        $this->zoneName = $zoneName;
    }

    /**
     * @return string
     */
    public function getApiKey(): string {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey): void {
        $this->apiKey = $apiKey;
    }

    /**
     * @return string
     */
    public function getApiSecret(): string {
        return $this->apiSecret;
    }

    /**
     * @param string $apiSecret
     */
    public function setApiSecret(string $apiSecret): void {
        $this->apiSecret = $apiSecret;
    }

    /**
     * @return string
     */
    public function getSecurityToken(): string {
        return $this->securityToken;
    }

    /**
     * @param string $securityToken
     */
    public function setSecurityToken(string $securityToken): void {
        $this->securityToken = $securityToken;
    }

    /**
     * @return int
     */
    public function getExpiration(): int {
        return $this->expiration;
    }

    /**
     * @param int $expiration
     */
    public function setExpiration(int $expiration): void {
        $this->expiration = $expiration;
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    public function getHttpClient(): ClientInterface {
        return $this->httpClient;
    }

    /**
     * @return bool
     */
    public function isSilent(): bool {
        return $this->silent;
    }

    /**
     * @param bool $silent
     */
    public function setSilent(bool $silent): void {
        $this->silent = $silent;
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger(): LoggerInterface {
        return $this->logger;
    }
}