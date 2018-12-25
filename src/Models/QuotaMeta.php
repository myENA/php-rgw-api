<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWQuotaMeta",
 *     @OA\Schema(
 *          type="object"
 *     ),
 *     @OA\Property(
 *          property="enabled",
 *          @OA\Schema(
 *              type="boolean"
 *          )
 *     ),
 *     @OA\Property(
 *          property="max_size_kb",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *     ),
 *     @OA\Property(
 *          property="max_objects",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *     ),
 *     @OA\Property(
 *          property="check_on_raw",
 *          @OA\Schema(
 *              type="boolean"
 *          )
 *     ),
 *     @OA\Property(
 *          property="max_size",
 *          @OA\Schema(
 *              type="integer"
 *          )
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