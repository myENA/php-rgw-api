<?php namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * Class IPv4Validator
 * @package MyENA\RGW\Validator
 */
class IPv4Validator implements Validator {
    const NAME = 'ipv4';

    /**
     * @return string
     */
    public function name(): string {
        return self::NAME;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function test($value): bool {
        return is_string($value) && filter_var($value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }
}