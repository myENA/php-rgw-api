<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModelCollection;

/**
 * Class UserKeyCollection
 * @package MyENA\RGW\Models
 */
class UserKeyCollection extends AbstractModelCollection {
    /**
     * @return string
     */
    protected function containedType(): string {
        return UserKey::class;
    }
}