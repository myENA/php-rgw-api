<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * Class BucketPolicyACLGroupMap
 * @package MyENA\RGW\Models
 */
class BucketPolicyACLGroupMap extends AbstractModel {
    /** @var string */
    protected $acl = '';
    /** @var string */
    protected $group = '';

    /**
     * @return string
     */
    public function getAcl(): string {
        return $this->acl;
    }

    /**
     * @return string
     */
    public function getGroup(): string {
        return $this->group;
    }
}