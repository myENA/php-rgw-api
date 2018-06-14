<?php namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * Class RequiredValidator
 * @package MyENA\RGW\Validator
 */
class RequiredValidator implements Validator {
    const NAME = 'required';

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
        return null !== $value;
    }
}