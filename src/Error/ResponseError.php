<?php declare(strict_types=1);

namespace MyENA\RGW\Error;

/**
 * Class ResponseError
 * @package MyENA\RGW\Error
 */
class ResponseError extends AbstractError
{

    /** @var string */
    protected $contents;

    /**
     * ResponseError constructor.
     * @param int $code
     * @param string $reason
     * @param string $contents
     */
    public function __construct(int $code, string $reason, string $contents = '')
    {
        parent::__construct($code, $reason);
        $this->contents = $contents;
    }

    /**
     * @return string
     */
    public function getContents(): string
    {
        return $this->contents;
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
        return false;
    }

    /**
     * @return bool
     */
    public function isResponseError(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf('Json Decode error: %d %s', $this->getCode(), $this->getReason());
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'code'   => $this->getCode(),
            'reason' => $this->getReason(),
        ];
    }
}