<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @SWG\Definition(
 *     definition="RGWMetadataBucketInfo",
 *     type="object",
 *     @SWG\Property(
 *          property="marker",
 *          type="string"
 *     ),
 *     @SWG\Property(
 *          property="name",
 *          type="string"
 *     ),
 *     @SWG\Property(
 *          property="data_extra_pool",
 *          type="string"
 *     ),
 *     @SWG\Property(
 *          property="pool",
 *          type="string"
 *     ),
 *     @SWG\Property(
 *          property="index_pool",
 *          type="string"
 *     ),
 *     @SWG\Property(
 *          property="tenant",
 *          type="string"
 *     ),
 *     @SWG\Property(
 *          property="bucket_id",
 *          type="string"
 *     ),
 *     @SWG\Property(
 *          property="explicit_placement",
 *          type="object",
 *          ref="#/definitions/RGWBucketPlacement"
 *     )
 * )
 */

/**
 * Class MetadataBucketInfo
 * @package MyENA\RGW\Models
 */
class MetadataBucketInfo extends AbstractModel
{
    /** @var string */
    protected $marker = '';
    /** @var string */
    protected $name = '';
    /** @var string */
    protected $dataExtraPool = '';
    /** @var string */
    protected $pool = '';
    /** @var string */
    protected $indexPool = '';
    /** @var string */
    protected $tenant = '';
    /** @var string */
    protected $bucketId = '';
    /** @var \MyENA\RGW\Models\BucketPlacement */
    protected $explicitPlacement = null;

    /**
     * MetadataBucketInfo constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (is_array($this->explicitPlacement)) {
            $this->explicitPlacement = new BucketPlacement($this->explicitPlacement);
        }
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDataExtraPool(): string
    {
        return $this->dataExtraPool;
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
    public function getTenant(): string
    {
        return $this->tenant;
    }

    /**
     * @return string
     */
    public function getBucketId(): string
    {
        return $this->bucketId;
    }

    /**
     * @return \MyENA\RGW\Models\BucketPlacement
     */
    public function getExplicitPlacement(): ?BucketPlacement
    {
        return $this->explicitPlacement;
    }
}