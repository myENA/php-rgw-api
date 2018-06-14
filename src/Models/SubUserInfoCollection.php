<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModelCollection;

/**
 * @SWG\Definition(
 *     definition="RGWSubUserInfoCollection",
 *     type="array",
 *     @SWG\Items(ref="#/definitions/RGWSubUserInfo")
 * )
 */

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
