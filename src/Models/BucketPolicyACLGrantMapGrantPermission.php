<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * Class BucketPolicyACLGrantMapGrantPermission
 * @package MyENA\RGW\Models
 */
class BucketPolicyACLGrantMapGrantPermission extends AbstractModel {
    /** @var int */
    protected $flags = 0;

    /**
     * @return int
     */
    public function getFlags(): int {
        return $this->flags;
    }
}
