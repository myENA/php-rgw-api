<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWBucketPolicyACLGrantMapGrantType",
 *     @OA\Schema(
 *          type="object"
 *     ),
 *     @OA\Property(
 *          property="type",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *     )
 * )
 */

/**
 * Class BucketPolicyACLGrantMapGrantType
 * @package MyENA\RGW\Models
 */
class BucketPolicyACLGrantMapGrantType extends AbstractModel
{
    /** @var int */
    protected $type = 0;

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }
}