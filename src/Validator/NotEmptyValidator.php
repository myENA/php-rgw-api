<?php declare(strict_types=1);

namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * NOTE: this validator should probably only be used on strings and MAYBE arrays.  you've been warned.
 *
 * Class NotEmptyValidator
 * @package MyENA\RGW\Validator
 */
class NotEmptyValidator implements Validator
{
    const NAME    = 'not-empty';
    const EXPECTS = 'type-specific non-empty value';

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
        switch ($type = gettype($value)) {
            case 'string':
                return '' !== $value;
            case 'integer':
                return 0 !== $value;
            case 'double':
                return 0 > $value || $value > 0;
            case 'boolean':
                // TODO: why are you setting a not empty validator on a bool value...?
                return !$value;
            case 'array':
                return 0 !== count($value);
            case 'object':
                // TODO: this is super inefficient, find better way
                return 0 !== count(get_object_vars($value));

            default:
                // catch null and resource types for now.
                return true;
        }
    }

    /**
     * @return string
     */
    public function expectedStatement(): string
    {
        return self::EXPECTS;
    }
}