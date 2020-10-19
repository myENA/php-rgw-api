<?php declare(strict_types=1);

namespace MyENA\RGW\Validator;

/**
 * Class EmailValidator
 * @package MyENA\RGW\Validator
 */
class EmailValidator extends StringValidator
{
    public const NAME = 'email';

    /**
     * @return string
     */
    public function name(): string
    {
        return self::NAME;
    }
}