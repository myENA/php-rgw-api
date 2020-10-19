<?php declare(strict_types=1);

namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * Class RequiredValidator
 * @package MyENA\RGW\Validator
 */
class RequiredValidator implements Validator
{
    public const NAME    = 'required';
    public const EXPECTS = 'value to be defined';

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
        return null !== $value;
    }

    /**
     * @return string
     */
    public function expectedStatement(): string
    {
        return self::EXPECTS;
    }
}