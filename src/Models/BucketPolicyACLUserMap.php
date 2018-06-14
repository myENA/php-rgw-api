<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @SWG\Definition(
 *     definition="RGWBucketPolicyACLUserMap",
 *     type="object",
 *     @SWG\Property(
 *          property="acl",
 *          type="string"
 *     ),
 *     @SWG\Property(
 *          property="user",
 *          type="string"
 *     )
 * )
 */

/**
 * Class BucketPolicyACLUserMap
 * @package MyENA\RGW\Models
 */
class BucketPolicyACLUserMap extends AbstractModel {
    /** @var string */
    protected $acl = '';
    /** @var string */
    protected $user = '';

    /**
     * @return string
     */
    public function getAcl(): string {
        return $this->acl;
    }

    /**
     * @return string
     */
    public function getUser(): string {
        return $this->user;
    }
}