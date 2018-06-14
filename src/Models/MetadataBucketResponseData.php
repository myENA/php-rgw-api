<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * Class MetadataBucketResponseData
 * @package MyENA\RGW\Models
 */
class MetadataBucketResponseData extends AbstractModel {
    /** @var \MyENA\RGW\Models\MetadataBucketInfo */
    protected $bucket = null;
    /** @var string */
    protected $hasBucketInfo = '';
    /** @var string */
    protected $linked = '';
    /** @var string */
    protected $creationTime = '';
    /** @var string */
    protected $owner = '';

    /**
     * MetadataBucketResponseData constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        parent::__construct($data);
        if (is_array($this->bucket)) {
            $this->bucket = new MetadataBucketInfo($this->bucket);
        }
    }

    /**
     * @return \MyENA\RGW\Models\MetadataBucketInfo
     */
    public function getBucket(): ?MetadataBucketInfo {
        return $this->bucket;
    }

    /**
     * @return string
     */
    public function getHasBucketInfo(): string {
        return $this->hasBucketInfo;
    }

    /**
     * @return string
     */
    public function getLinked(): string {
        return $this->linked;
    }

    /**
     * @return string
     */
    public function getCreationTime(): string {
        return $this->creationTime;
    }

    /**
     * @return string
     */
    public function getOwner(): string {
        return $this->owner;
    }
}