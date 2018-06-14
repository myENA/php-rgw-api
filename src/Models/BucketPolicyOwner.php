<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * Class BucketPolicyOwner
 * @package MyENA\RGW\Models
 */
class BucketPolicyOwner extends AbstractModel {
    /** @var string */
    protected $displayName = '';
    /** @var string */
    protected $id = '';

    /**
     * @return string
     */
    public function getDisplayName(): string {
        return $this->displayName;
    }

    /**
     * @return string
     */
    public function getId(): string {
        return $this->id;
    }
}