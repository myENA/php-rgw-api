<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWMetadataBucketInstanceResponseData",
 *     type="object",
 *     allOf={
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="bucket_info",
 *                  type="object",
 *                  @OA\Schema(ref="#/components/schemas/RGWMetadataBucketInstanceInfo")
 *              ),
 *              @OA\Property(
 *                  property="attrs",
 *                  type="array",
 *                  @OA\Items(
 *                      @OA\Schema(ref="#/components/schemas/RGWMetadataAttribute")
 *                  )
 *              )
 *          )
 *      }
 * )
 */

/**
 * Class MetadataBucketInstanceResponseData
 * @package MyENA\RGW\Models
 */
class MetadataBucketInstanceResponseData extends AbstractModel
{
    /** @var \MyENA\RGW\Models\MetadataBucketInstanceInfo */
    protected $bucketInfo = null;

    /** @var \MyENA\RGW\Models\MetadataAttribute[] */
    protected $attrs = [];

    /**
     * MetadataBucketInstanceData constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (is_array($this->bucketInfo)) {
            $this->bucketInfo = new MetadataBucketInstanceInfo($this->bucketInfo);
        }
        if (is_array($this->attrs)) {
            foreach ($this->attrs as &$attr) {
                $attr = new MetadataAttribute($attr);
            }
        }
    }

    /**
     * @return \MyENA\RGW\Models\MetadataBucketInstanceInfo
     */
    public function getBucketInfo(): ?MetadataBucketInstanceInfo
    {
        return $this->bucketInfo;
    }

    /**
     * @return \MyENA\RGW\Models\MetadataAttribute[]
     */
    public function getAttrs(): array
    {
        return $this->attrs;
    }
}