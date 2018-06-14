<?php namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * Class MACValidator
 * @package MyENA\RGW\Validator
 */
class MACValidator implements Validator {
    const NAME = 'mac';

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
        return is_string($value) && filter_var($value, FILTER_VALIDATE_MAC);
    }
}
