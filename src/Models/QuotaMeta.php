<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @SWG\Definition(
 *     definition="RGWQuotaMeta",
 *     type="object",
 *     @SWG\Property(
 *          property="enabled",
 *          type="boolean"
 *     ),
 *     @SWG\Property(
 *          property="max_size_kb",
 *          type="integer"
 *     ),
 *     @SWG\Property(
 *          property="max_objects",
 *          type="integer"
 *     ),
 *     @SWG\Property(
 *          property="check_on_raw",
 *          type="boolean"
 *     ),
 *     @SWG\Property(
 *          property="max_size",
 *          type="integer"
 *     )
 * )
 */

/**
 * Class QuotaMeta
 * @package MyENA\RGW\Models
 */
class QuotaMeta extends AbstractModel
{
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
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @return int
     */
    public function getMaxSizeKb(): int
    {
        return $this->maxSizeKb;
    }

    /**
     * @return int
     */
    public function getMaxObjects(): int
    {
        return $this->maxObjects;
    }

    /**
     * @return bool
     */
    public function isCheckOnRaw(): bool
    {
        return $this->checkOnRaw;
    }

    /**
     * @return int
     */
    public function getMaxSize(): int
    {
        return $this->maxSize;
    }
}