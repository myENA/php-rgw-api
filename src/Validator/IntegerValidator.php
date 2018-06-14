<?php namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * Class IntegerValidator
 * @package MyENA\RGW\Validator
 */
class IntegerValidator implements Validator {
    const NAME = 'integer';

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
        if (null === $value) {
            return false;
        } else if (is_int($value)) {
            return true;
        } else if (!is_string($value)) {
            return false;
        } else if ('-' === $value[0] || '+' === $value[0]) {
            return ctype_digit(substr($value, 1));
        }
        return ctype_digit($value);
    }
}