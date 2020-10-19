<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="RGWMetadataBucketResponse",
 *     type="object",
 *     allOf={
 *          @OA\Schema(ref="#/components/schemas/RGWMetadataResponse"),
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  ref="#/components/schemas/RGWMetadataBucketResponseData"
 *              )
 *          )
 *     }
 * )
 */

/**
 * Class MetadataBucketResponse
 * @package MyENA\RGW\Models
 */
class MetadataBucketResponse extends AbstractMetadataResponse
{
    /** @var \MyENA\RGW\Models\MetadataBucketResponseData */
    protected $data = null;

    /**
     * MetadataBucketResponse constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (is_array($this->data)) {
            $this->data = new MetadataBucketResponseData($this->data);
        }
    }

    /**
     * @return \MyENA\RGW\Models\MetadataBucketResponseData
     */
    public function getData(): ?MetadataBucketResponseData
    {
        return $this->data;
    }
}