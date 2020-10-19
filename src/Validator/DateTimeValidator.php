<?php declare(strict_types=1);

namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * Class DateTimeValidator
 * @package MyENA\RGW\Validator
 */
class DateTimeValidator implements Validator
{
    public const NAME    = 'datetime';
    public const EXPECTS = 'value to be instance of ' . \DateTime::class . ' or string conforming to ' . RGW_QUERY_DATETIME_FORMAT;

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
        return (is_object($value) && $value instanceof \DateTime) ||
            (is_string($value) && false !== date(RGW_QUERY_DATETIME_FORMAT, $value));
    }

    /**
     * @return string
     */
    public function expectedStatement(): string
    {
        return self::EXPECTS;
    }
}