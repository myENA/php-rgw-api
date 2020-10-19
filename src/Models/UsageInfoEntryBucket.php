<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="RGWUsageInfoEntryBucket",
 *     type="object",
 *     @OA\Property(
 *          property="bucket",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="time",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="epoch",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="owner",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="categories",
 *          type="array",
 *          @OA\Items(
 *              @OA\Schema(ref="#/components/schemas/RGWUsageInfoCategory")
 *          )
 *     )
 * )
 */

/**
 * Class UsageInfoEntryBucket
 * @package MyENA\RGW\Models
 */
class UsageInfoEntryBucket extends AbstractModel
{
    /** @var string */
    protected $bucket = '';
    /** @var string */
    protected $time = '';
    /** @var int */
    protected $epoch = 0;
    /** @var string */
    protected $owner = '';
    /** @var \MyENA\RGW\Models\UsageInfoCategory[] */
    protected $categories = null;

    /**
     * UsageInfoEntryBucket constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (is_array($this->categories)) {
            foreach ($this->categories as $i => &$category) {
                $category = new UsageInfoCategory($category);
            }
        }
    }

    /**
     * @return string
     */
    public function getBucket(): string
    {
        return $this->bucket;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @return int
     */
    public function getEpoch(): int
    {
        return $this->epoch;
    }

    /**
     * @return string
     */
    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * @return \MyENA\RGW\Models\UsageInfoCategory[]
     */
    public function getCategories(): array
    {
        return $this->categories;
    }
}