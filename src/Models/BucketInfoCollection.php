<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModelCollection;

/**
 * Class BucketInfoCollection
 * @package MyENA\RGW\Models
 */
class BucketInfoCollection extends AbstractModelCollection {
    /**
     * @return string
     */
    protected function containedType(): string {
        return BucketInfo::class;
    }
}