<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWBucketInfo",
 *     type="object",
 *     allOf={
 *         @OA\Schema(
 *              @OA\Property(
 *                  property="bucket",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="pool",
 *                  type="string"
 *             ),
 *             @OA\Property(
 *                  property="index_pool",
 *                  type="string"
 *             ),
 *             @OA\Property(
 *                  property="id",
 *                  type="string"
 *             ),
 *             @OA\Property(
 *                  property="marker",
 *                  type="string"
 *             ),
 *             @OA\Property(
 *                  property="owner",
 *                  type="string"
 *             ),
 *             @OA\Property(
 *                  property="ver",
 *                  type="string"
 *             ),
 *             @OA\Property(
 *                  property="master_ver",
 *                  type="string"
 *             ),
 *             @OA\Property(
 *                  property="mtime",
 *                  type="string"
 *             ),
 *             @OA\Property(
 *                  property="max_marker",
 *                  type="string"
 *             ),
 *             @OA\Property(
 *                  property="usage",
 *                  type="object",
 *                  @OA\Schema(ref="#/components/schemas/RGWBucketUsage")
 *             ),
 *             @OA\Property(
 *                  property="bucket_quota",
 *                  type="object",
 *                  @OA\Schema(ref="#/components/schemas/RGWQuotaMeta")
 *             ),
 *             @OA\Property(
 *                  property="zonegroup",
 *                  type="string"
 *             ),
 *             @OA\Property(
 *                  property="placement_rule",
 *                  type="string"
 *             ),
 *             @OA\Property(
 *                  property="explicit_placement",
 *                  type="object",
 *                  @OA\Schema(ref="#/components/schemas/RGWBucketPlacement")
 *             ),
 *             @OA\Property(
 *                  property="index_type",
 *                  type="string"
 *             )
 *          )
 *      }
 * )
 */

/**
 * Class BucketInfo
 * @package MyENA\RGW\Models
 */
class BucketInfo extends AbstractModel
{
    /** @var string */
    protected $bucket = '';
    /** @var string */
    protected $pool = '';
    /** @var string */
    protected $indexPool = '';
    /** @var string */
    protected $id = '';
    /** @var string */
    protected $marker = '';
    /** @var string */
    protected $owner = '';
    /** @var string */
    protected $ver = '';
    /** @var string */
    protected $masterVer = '';
    /** @var string */
    protected $mtime = '';
    /** @var string */
    protected $maxMarker = '';
    /** @var \MyENA\RGW\Models\BucketUsage */
    protected $usage = null;
    /** @var \MyENA\RGW\Models\QuotaMeta */
    protected $bucketQuota = null;
    /** @var string */
    protected $zonegroup = '';
    /** @var string */
    protected $placementRule = '';
    /** @var \MyENA\RGW\Models\BucketPlacement */
    protected $explicitPlacement = null;
    /** @var string */
    protected $indexType = '';

    /**
     * BucketStatsResponse constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (is_array($this->usage)) {
            $this->usage = new BucketUsage($this->usage);
        }
        if (is_array($this->bucketQuota)) {
            $this->bucketQuota = new QuotaMeta($this->bucketQuota);
        }
        if (is_array($this->explicitPlacement)) {
            $this->explicitPlacement = new BucketPlacement($this->explicitPlacement);
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
    public function getPool(): string
    {
        return $this->pool;
    }

    /**
     * @return string
     */
    public function getIndexPool(): string
    {
        return $this->indexPool;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMarker(): string
    {
        return $this->marker;
    }

    /**
     * @return string
     */
    public function getOwner(): string
    {
        return $this->owner;
    }

    /**
     * @return string
     */
    public function getVer(): string
    {
        return $this->ver;
    }

    /**
     * @return string
     */
    public function getMasterVer(): string
    {
        return $this->masterVer;
    }

    /**
     * @return string
     */
    public function getMtime(): string
    {
        return $this->mtime;
    }

    /**
     * @return string
     */
    public function getMaxMarker(): string
    {
        return $this->maxMarker;
    }

    /**
     * @return \MyENA\RGW\Models\BucketUsage
     */
    public function getUsage(): ?BucketUsage
    {
        return $this->usage;
    }

    /**
     * @return \MyENA\RGW\Models\QuotaMeta
     */
    public function getBucketQuota(): ?QuotaMeta
    {
        return $this->bucketQuota;
    }

    /**
     * @return string
     */
    public function getZonegroup(): string
    {
        return $this->zonegroup;
    }

    /**
     * @return string
     */
    public function getPlacementRule(): string
    {
        return $this->placementRule;
    }

    /**
     * @return \MyENA\RGW\Models\BucketPlacement
     */
    public function getExplicitPlacement(): ?BucketPlacement
    {
        return $this->explicitPlacement;
    }

    /**
     * @return string
     */
    public function getIndexType(): string
    {
        return $this->indexType;
    }
}