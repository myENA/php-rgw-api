<?php namespace MyENA\RGW\Error;

/**
 * Class TransportError
 * @package MyENA\RGW\Error
 */
class TransportError extends AbstractError {
    /**
     * @return bool
     */
    public function isTransportError(): bool {
        return true;
    }

    /**
     * @return bool
     */
    public function isApiError(): bool {
        return false;
    }

    /**
     * @return bool
     */
    public function isResponseError(): bool {
        return false;
    }

    /**
     * @return string
     */
    public function __toString() {
        return sprintf('%d: %s', $this->getCode(), $this->getReason());
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        return [
            'code'   => $this->getCode(),
            'reason' => $this->getReason(),
        ];
    }
}