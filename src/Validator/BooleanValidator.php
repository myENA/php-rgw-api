<?php declare(strict_types=1);

namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * Class BooleanValidator
 * @package MyENA\RGW\Validator
 */
class BooleanValidator implements Validator
{
    public const NAME    = 'boolean';
    public const EXPECTS = 'boolean (true|false)';

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
        return is_bool($value);
    }

    /**
     * @return string
     */
    public function expectedStatement(): string
    {
        return self::EXPECTS;
    }
}