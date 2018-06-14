<?php namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * Class EmailValidator
 * @package MyENA\RGW\Validator
 */
class EmailValidator implements Validator {
    const NAME = 'email';

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
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}