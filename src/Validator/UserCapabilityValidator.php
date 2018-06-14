<?php namespace MyENA\RGW\Validator;

use MyENA\RGW\Models\UserCapability;
use MyENA\RGW\Validator;

/**
 * Class UserCapabilityValidator
 * @package MyENA\RGW\Validator
 */
class UserCapabilityValidator implements Validator {
    const NAME = 'user-capability';

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
        return ($value instanceof UserCapability) &&
            in_array($value->getType(), RGW_CAPABILITY_TYPES, true) &&
            in_array($value->getPermission(), RGW_CAPABILITY_VALUES);
    }
}