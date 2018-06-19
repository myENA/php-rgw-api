<?php declare(strict_types=1);

namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * TODO: Currently does not support scientific notation
 *
 * Class IntegerValidator
 * @package MyENA\RGW\Validator
 */
class IntegerValidator implements Validator
{
    const NAME    = 'integer';
    const EXPECTS = 'integer or string containing only numbers with optional sign prefix';

    /**
     * @return string
     */
    public function name(): string
    {
        return self::NAME;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function test($value): bool
    {
        if (null === $value) {
            return false;
        } elseif (is_int($value)) {
            return true;
        } elseif (!is_string($value)) {
            return false;
        } elseif ('-' === $value[0] || '+' === $value[0]) {
            return ctype_digit(substr($value, 1));
        }
        return ctype_digit($value);
    }

    /**
     * @return string
     */
    public function expectedStatement(): string
    {
        return self::EXPECTS;
    }
}