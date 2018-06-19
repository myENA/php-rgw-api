<?php declare(strict_types=1);

namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * Class StringValidator
 * @package MyENA\RGW\Argument\Validator
 */
class StringValidator implements Validator
{
    const NAME    = 'string';
    const EXPECTS = 'value to be a string';

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
        return is_string($value);
    }

    /**
     * @return string
     */
    public function expectedStatement(): string
    {
        return self::EXPECTS;
    }
}