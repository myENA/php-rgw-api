<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * Class MetadataVersion
 * @package MyENA\RGW\Models
 */
class MetadataVersion extends AbstractModel {
    /** @var string */
    protected $tag = '';
    /** @var int */
    protected $ver = 0;

    /**
     * @return string
     */
    public function getTag(): string {
        return $this->tag;
    }

    /**
     * @return int
     */
    public function getVer(): int {
        return $this->ver;
    }
}