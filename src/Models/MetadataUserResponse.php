<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="RGWMetadataUserResponse",
 *     type="object",
 *     allOf={
 *          @OA\Schema(ref="#/components/schemas/RGWMetadataResponse"),
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="data",
 *                  type="object",
 *                  ref="#/components/schemas/RGWMetadataUserInfo"
 *              )
 *          )
 *      }
 * )
 */

/**
 * Class MetadataUserResponse
 * @package MyENA\RGW\Models
 */
class MetadataUserResponse extends AbstractMetadataResponse
{
    /** @var \MyENA\RGW\Models\MetadataUserInfo */
    protected $data = null;

    /**
     * MetadataUserResponse constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (is_array($this->data)) {
            $this->data = new MetadataUserInfo($this->data);
        }
    }

    /**
     * @return \MyENA\RGW\Models\MetadataUserInfo
     */
    public function getData(): ?MetadataUserInfo
    {
        return $this->data;
    }
}