<?php declare(strict_types=1);

namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * Class TenantNameValidator
 * @package MyENA\RGW\Validator
 */
class TenantNameValidator implements Validator
{
    public const NAME       = 'tenant';
    public const TEST_REGEX = '{^[a-zA-Z0-9_]+$}';

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
        return is_string($value) && (bool)preg_match(self::TEST_REGEX, $value);
    }

    /**
     * @return string
     */
    public function expectedStatement(): string
    {
        return 'string conforming to ' . self::TEST_REGEX;
    }
}