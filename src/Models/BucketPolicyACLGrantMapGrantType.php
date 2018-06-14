<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @SWG\Definition(
 *     definition="RGWBucketPolicyACLGrantMapGrantType",
 *     type="object",
 *     @SWG\Property(
 *          property="type",
 *          type="integer"
 *     )
 * )
 */

/**
 * Class BucketPolicyACLGrantMapGrantType
 * @package MyENA\RGW\Models
 */
class BucketPolicyACLGrantMapGrantType extends AbstractModel {
    /** @var int */
    protected $type = 0;

    /**
     * @return int
     */
    public function getType(): int {
        return $this->type;
    }
}