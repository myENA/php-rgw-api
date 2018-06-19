<?php declare(strict_types=1);

namespace MyENA\RGW\Error;

use Psr\Http\Message\ResponseInterface;

/**
 * Class ApiError
 * @package MyENA\RGW\Error
 */
class ApiError extends AbstractError
{
    /** @var string */
    private $errorCode = '';
    /** @var string */
    private $requestId = '';
    /** @var string */
    private $hostId = '';

    /**
     * ApiError constructor.
     * @param int $code
     * @param string $reason
     * @param array $data
     */
    public function __construct(int $code, string $reason, array $data = [])
    {
        parent::__construct($code, $reason);
        $this->errorCode = $data['Code'] ?? '';
        $this->requestId = $data['RequestId'] ?? '';
        $this->hostId = $data['HostId'] ?? '';
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return \MyENA\RGW\Error\ApiError
     */
    public static function fromResponse(ResponseInterface $response): ApiError
    {
        $code = $response->getStatusCode();
        $reason = $response->getReasonPhrase();
        $data = [];

        $body = $response->getBody();
        $body->rewind();
        $contents = $body->getContents();
        $body->rewind();
        $decoded = json_decode($contents);
        if (JSON_ERROR_NONE === json_last_error() && is_object($decoded)) {
            $data = (array)$decoded;
        }

        return new static($code, $reason, $data);
    }

    /**
     * @return bool
     */
    public function isTransportError(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isApiError(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isResponseError(): bool
    {
        return false;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            'Status: %d %s; Code: %s, RequestId: %s; HostId: %s',
            $this->getCode(),
            $this->getReason(),
            $this->getErrorCode(),
            $this->getRequestId(),
            $this->getHostId()
        );
    }

    /**
     * @return string
     */
    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    /**
     * @return string
     */
    public function getRequestId(): string
    {
        return $this->requestId;
    }

    /**
     * @return string
     */
    public function getHostId(): string
    {
        return $this->hostId;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'code'   => $this->getCode(),
            'reason' => $this->getReason(),
            'error'  => [
                'Code'      => $this->getErrorCode(),
                'RequestId' => $this->getRequestId(),
                'HostId'    => $this->getRequestId(),
            ],
        ];
    }
}