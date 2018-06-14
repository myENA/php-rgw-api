<?php namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * Class StringValidator
 * @package MyENA\RGW\Argument\Validator
 */
class StringValidator implements Validator {
    const NAME = 'string';

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
        return is_string($value);
    }
}