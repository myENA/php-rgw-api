<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModelCollection;

/**
 * @SWG\Definition(
 *     definition="RGWBucketInfoCollection",
 *     type="array",
 *     @SWG\Items(ref="#/definitions/RGWBucketInfo")
 * )
 */

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