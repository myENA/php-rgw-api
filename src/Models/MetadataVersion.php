<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWMetadataVersion",
 *     @OA\Schema(
 *          type="object"
 *     ),
 *     @OA\Property(
 *          property="tag",
 *          @OA\Schema(
 *              type="string"
 *          )
 *     ),
 *     @OA\Property(
 *          property="ver",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *     )
 * )
 */

/**
 * Class MetadataVersion
 * @package MyENA\RGW\Models
 */
class MetadataVersion extends AbstractModel
{
    /** @var string */
    protected $tag = '';
    /** @var int */
    protected $ver = 0;

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * @return int
     */
    public function getVer(): int
    {
        return $this->ver;
    }
}