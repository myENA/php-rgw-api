<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModelCollection;

/**
 * Class SubUserInfoCollection
 * @package MyENA\RGW\Models
 */
class SubUserInfoCollection extends AbstractModelCollection {
    /**
     * @return string
     */
    protected function containedType(): string {
        return SubUserInfo::class;
    }
}
