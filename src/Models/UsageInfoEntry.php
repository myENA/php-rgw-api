<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="RGWUsageInfoEntry",
 *     type="object",
 *     @OA\Property(
 *          property="user",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="buckets",
 *          type="array",
 *          @OA\Items(
 *              @OA\Schema(ref="#/components/schemas/RGWUsageInfoEntryBucket")
 *          )
 *     )
 * )
 */

/**
 * Class UsageInfoEntry
 * @package MyENA\RGW\Models
 */
class UsageInfoEntry extends AbstractModel
{
    /** @var string */
    protected $user = '';
    /** @var \MyENA\RGW\Models\UsageInfoEntryBucket[] */
    protected $buckets = [];

    /**
     * UsageInfoEntry constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (is_array($this->buckets)) {
            foreach ($this->buckets as &$bucket) {
                $bucket = new UsageInfoEntryBucket($bucket);
            }
        }
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return \MyENA\RGW\Models\UsageInfoEntryBucket[]
     */
    public function getBuckets(): array
    {
        return $this->buckets;
    }
}