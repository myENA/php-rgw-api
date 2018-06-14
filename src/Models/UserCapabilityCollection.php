<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModelCollection;

/**
 * Class UserCapabilityCollection
 * @package MyENA\RGW\Models
 */
class UserCapabilityCollection extends AbstractModelCollection {
    /**
     * @return string
     */
    protected function containedType(): string {
        return UserCapability::class;
    }
}