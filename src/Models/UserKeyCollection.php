<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModelCollection;

/**
 * @SWG\Definition(
 *     definition="RGWUserKeyCollection",
 *     type="array",
 *     @SWG\Items(ref="#/definitions/RGWUserKey")
 * )
 */

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