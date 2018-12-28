<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWMetadataBucketInstanceInfo",
 *     type="object",
 *     @OA\Property(
 *          property="bucket",
 *          type="object",
 *          ref="#/components/schemas/RGWMetadataBucketInfo"
 *     ),
 *     @OA\Property(
 *          property="num_shards",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="placement_rule",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="swift_ver_location",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="flags",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="has_website",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="swift_versioning",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="owner",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="requester_pays",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="index_type",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="bi_shard_hash_type",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="has_instance_obj",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="creation_time",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="zonegroup",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="quota",
 *          type="object",
 *          ref="#/components/schemas/RGWQuotaMeta"
 *     ),
 *     @OA\Property(
 *          property="mdsearch_config",
 *          type="array",
 *          @OA\Items(type="string"),
 *     ),
 *     @OA\Property(
 *          property="reshard_status",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="new_bucket_instance_id",
 *          type="string"
 *     )
 * )
 */

/**
 * Class MetadataBucketInstanceInfo
 * @package MyENA\RGW\Models
 */
class MetadataBucketInstanceInfo extends AbstractModel
{
    /** @var \MyENA\RGW\Models\MetadataBucketInfo */
    protected $bucket = null;
    /** @var int */
    protected $numShards = 0;
    /** @var string */
    protected $placementRule = '';
    /** @var string */
    protected $swiftVerLocation = '';
    /** @var int */
    protected $flags = 0;
    /** @var string */
    protected $hasWebsite = '';
    /** @var string */
    protected $swiftVersioning = '';
    /** @var string */
    protected $owner = '';
    /** @var string */
    protected $requesterPays = '';
    /** @var int */
    protected $indexType = 0;
    /** @var int */
    protected $biShardHashType = 0;
    /** @var string */
    protected $hasInstanceObj = '';
    /** @var string */
    protected $creationTime = '';
    /** @var string */
    protected $zonegroup = '';
    /** @var \MyENA\RGW\Models\QuotaMeta */
    protected $quota = null;
    /** @var array */
    protected $mdsearchConfig = [];
    /** @var int */
    protected $reshardStatus = 0;
    /** @var string */
    protected $newBucketInstanceId = '';

    /**
     * MetadataBucketInstanceResponseDataBucketInfo constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (is_array($this->bucket)) {
            $this->bucket = new MetadataBucketInfo($this->bucket);
        }
        if (is_array($this->quota)) {
            $this->quota = new QuotaMeta($this->quota);
        }
    }

    /**
     * @return \MyENA\RGW\Models\MetadataBucketInfo
     */
    public function getBucket(): ?MetadataBucketInfo
    {
        return $this->bucket;
    }

    /**
     * @return int
     */
    public function getNumShards(): int
    {
        return $this->numShards;
    }

    /**
     * @return string
     */
    public function getPlacementRule(): string
    {
        return $this->placementRule;
    }

    /**
     * @return string
     */
    public function getSwiftVerLocation(): string
    {
        return $this->swiftVerLocation;
    }

    /**
     * @return int
     */
    public function getFlags(): int
    {
        return $this->flags;
    }

    /**
     * @return string
     */
    public function getHasWebsite(): string
    {
        return $this->hasWebsite;
    }

    /**
     * @return string
     */
    public function getSwiftVersioning(): string
    {
        return $this->swiftVersioning;
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
    public function getRequesterPays(): string
    {
        return $this->requesterPays;
    }

    /**
     * @return int
     */
    public function getIndexType(): int
    {
        return $this->indexType;
    }

    /**
     * @return int
     */
    public function getBiShardHashType(): int
    {
        return $this->biShardHashType;
    }

    /**
     * @return string
     */
    public function getHasInstanceObj(): string
    {
        return $this->hasInstanceObj;
    }

    /**
     * @return string
     */
    public function getCreationTime(): string
    {
        return $this->creationTime;
    }

    /**
     * @return string
     */
    public function getZonegroup(): string
    {
        return $this->zonegroup;
    }

    /**
     * @return \MyENA\RGW\Models\QuotaMeta
     */
    public function getQuota(): ?QuotaMeta
    {
        return $this->quota;
    }

    /**
     * @return array
     */
    public function getMdsearchConfig(): array
    {
        return $this->mdsearchConfig;
    }

    /**
     * @return int
     */
    public function getReshardStatus(): int
    {
        return $this->reshardStatus;
    }

    /**
     * @return string
     */
    public function getNewBucketInstanceId(): string
    {
        return $this->newBucketInstanceId;
    }
}