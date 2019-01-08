<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWMetadataAttribute",
 *     type="object",
 *     @OA\Schema(
 *         @OA\Property(
 *              property="key",
 *              type="string"
 *         ),
 *         @OA\Property(
 *             property="val",
 *             type="string"
 *         )
 *     )
 * )
 */

/**
 * Class MetadataAttribute
 * @package MyENA\RGW\Models
 */
class MetadataAttribute extends AbstractModel
{
    /** @var string */
    protected $key = '';
    /** @var string */
    protected $val = '';

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getVal(): string
    {
        return $this->val;
    }
}