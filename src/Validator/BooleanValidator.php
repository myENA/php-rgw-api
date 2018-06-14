<?php namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * Class BooleanValidator
 * @package MyENA\RGW\Validator
 */
class BooleanValidator implements Validator {
    const NAME = 'bool';

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
        return is_bool($value);
    }
}