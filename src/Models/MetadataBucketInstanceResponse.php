<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

/**
 * @OA\Schema(
 *     schema="RGWMetadataBucketInstanceResponse",
 *     type="object",
 *     allOf={
 *          @OA\Schema(ref="#/components/schemas/RGWMetadataResponse"),
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  ref="#/components/schemas/RGWMetadataBucketInstanceResponseData"
 *              )
 *          )
 *      }
 * )
 */

/**
 * Class MetadataBucketInstanceResponse
 * @package MyENA\RGW\Models
 */
class MetadataBucketInstanceResponse extends AbstractMetadataResponse
{
    /** @var \MyENA\RGW\Models\MetadataBucketInstanceResponseData */
    protected $data = null;

    /**
     * MetadataBucketInstance constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (is_array($this->data)) {
            $this->data = new MetadataBucketInstanceResponseData($this->data);
        }
    }

    /**
     * @return \MyENA\RGW\Models\MetadataBucketInstanceResponseData
     */
    public function getData(): ?MetadataBucketInstanceResponseData
    {
        return $this->data;
    }
}