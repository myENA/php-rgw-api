<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

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