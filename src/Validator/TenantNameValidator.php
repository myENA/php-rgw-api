<?php namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * Class TenantNameValidator
 * @package MyENA\RGW\Validator
 */
class TenantNameValidator implements Validator {
    const NAME       = 'tenant';
    const TEST_REGEX = '{^[a-zA-Z0-9_]+$}';

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
        return (bool)preg_match(self::TEST_REGEX, $value);
    }
}