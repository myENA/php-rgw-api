<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * Class QuotaMeta
 * @package MyENA\RGW\Models
 */
class QuotaMeta extends AbstractModel {
    /** @var bool */
    protected $enabled = false;
    /** @var int */
    protected $maxSizeKb = 0;
    /** @var int */
    protected $maxObjects = 0;
    /** @var bool */
    protected $checkOnRaw = false;
    /** @var int */
    protected $maxSize = 0;

    /**
     * @return bool
     */
    public function isEnabled(): bool {
        return $this->enabled;
    }

    /**
     * @return int
     */
    public function getMaxSizeKb(): int {
        return $this->maxSizeKb;
    }

    /**
     * @return int
     */
    public function getMaxObjects(): int {
        return $this->maxObjects;
    }

    /**
     * @return bool
     */
    public function isCheckOnRaw(): bool {
        return $this->checkOnRaw;
    }

    /**
     * @return int
     */
    public function getMaxSize(): int {
        return $this->maxSize;
    }
}