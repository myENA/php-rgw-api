<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * Class MetadataAttribute
 * @package MyENA\RGW\Models
 */
class MetadataAttribute extends AbstractModel {
    /** @var string */
    protected $key = '';
    /** @var string */
    protected $val = '';

    /**
     * @return string
     */
    public function getKey(): string {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getVal(): string {
        return $this->val;
    }
}