<?php declare(strict_types=1);

namespace MyENA\RGW\Error;

use MyENA\RGW\Error;

/**
 * Class AbstractError
 * @package MyENA\RGW\Error
 */
abstract class AbstractError implements Error
{
    /** @var int */
    private $code;
    /** @var string */
    private $reason;

    /**
     * AbstractError constructor.
     * @param int $code
     * @param string $reason
     */
    public function __construct(int $code, string $reason)
    {
        $this->code = $code;
        $this->reason = $reason;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }
}