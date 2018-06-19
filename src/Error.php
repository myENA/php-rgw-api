<?php declare(strict_types=1);

namespace MyENA\RGW;

/**
 * Interface Error
 * @package MyENA\RGW
 */
interface Error extends \JsonSerializable
{
    /**
     * Returns the code as it makes sense in the scope of the error.
     *
     * @return int
     */
    public function getCode(): int;

    /**
     * Returns the raw response message.  See individual implementor classes.
     *
     * @return string
     */
    public function getReason(): string;

    /**
     * Must return true if this error was due to a transport layer issue
     *
     * @return bool
     */
    public function isTransportError(): bool;

    /**
     * Must return true if transport succeeded, but request failed
     *
     * @return bool
     */
    public function isApiError(): bool;

    /**
     * Must return true if response handling failed.
     *
     * @return bool
     */
    public function isResponseError(): bool;

    /**
     * @return string
     */
    public function __toString();
}