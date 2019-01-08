<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

/**
 * @OA\Schema(
 *     schema="RGWMetadataUserInfo",
 *     type="object",
 *     @OA\Schema(ref="$/definitions/RGWUserInfo"),
 *     @OA\Property(
 *          property="auid",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="op_mask",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="default_placement",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="placement_tags",
 *          type="array",
 *          @OA\Items(type="string"),
 *     ),
 *     @OA\Property(
 *          property="bucket_quota",
 *          type="object",
 *          ref="#/components/schemas/RGWQuotaMeta"
 *     ),
 *     @OA\Property(
 *          property="user_quota",
 *          type="object",
 *          @OA\Schema(ref="#/components/schemas/RGWQuotaMeta")
 *     ),
 *     @OA\Property(
 *          property="temp_url_keys",
 *          type="array",
 *          @OA\Items(type="string"),
 *     ),
 *     @OA\Property(
 *          property="type",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="attrs",
 *          type="array",
 *          @OA\Items(
 *              @OA\Schema(ref="#/components/schemas/RGWMetadataAttribute")
 *          )
 *     )
 * )
 */

/**
 * Class MetadataUserInfo
 * @package MyENA\RGW\Models
 */
class MetadataUserInfo extends UserInfo
{
    /** @var int */
    protected $auid = 0;
    /** @var string */
    protected $opMask = '';
    /** @var string */
    protected $defaultPlacement = '';
    /** @var array */
    protected $placementTags = [];
    /** @var \MyENA\RGW\Models\QuotaMeta */
    protected $bucketQuota = null;
    /** @var \MyENA\RGW\Models\QuotaMeta */
    protected $userQuota = null;
    /** @var array */
    protected $tempUrlKeys = [];
    /** @var string */
    protected $type = '';
    /** @var \MyENA\RGW\Models\MetadataAttribute[] */
    protected $attrs = [];

    /**
     * MetadataUserInfo constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (is_array($this->bucketQuota)) {
            $this->bucketQuota = new QuotaMeta($this->bucketQuota);
        }
        if (is_array($this->userQuota)) {
            $this->userQuota = new QuotaMeta($this->userQuota);
        }
        if (is_array($this->attrs)) {
            foreach ($this->attrs as &$attr) {
                if (is_array($attr)) {
                    $attr = new MetadataAttribute($attr);
                }
            }
        }
    }

    /**
     * @return int
     */
    public function getAuid(): int
    {
        return $this->auid;
    }

    /**
     * @return string
     */
    public function getOpMask(): string
    {
        return $this->opMask;
    }

    /**
     * @return string
     */
    public function getDefaultPlacement(): string
    {
        return $this->defaultPlacement;
    }

    /**
     * @return array
     */
    public function getPlacementTags(): array
    {
        return $this->placementTags;
    }

    /**
     * @return \MyENA\RGW\Models\QuotaMeta
     */
    public function getBucketQuota(): ?QuotaMeta
    {
        return $this->bucketQuota;
    }

    /**
     * @return \MyENA\RGW\Models\QuotaMeta
     */
    public function getUserQuota(): ?QuotaMeta
    {
        return $this->userQuota;
    }

    /**
     * @return array
     */
    public function getTempUrlKeys(): array
    {
        return $this->tempUrlKeys;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return \MyENA\RGW\Models\MetadataAttribute[]
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }
}