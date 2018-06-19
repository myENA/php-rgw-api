<?php declare(strict_types=1);

namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * Class EmailValidator
 * @package MyENA\RGW\Validator
 */
class EmailValidator implements Validator
{
    const NAME    = 'email';
    const EXPECTS = 'string conforming to PHP email filter spec';

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
        return is_string($value) && false !== filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @return string
     */
    public function expectedStatement(): string
    {
        return self::EXPECTS;
    }
}