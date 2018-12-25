<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWBucketPolicyACLGrantMapGrantPermission",
 *     @OA\Schema(
 *          type="object"
 *     ),
 *     @OA\Property(
 *          property="flags",
 *          @OA\Schema(
 *              type="integer"
 *          )
 *     )
 * )
 */

/**
 * Class BucketPolicyACLGrantMapGrantPermission
 * @package MyENA\RGW\Models
 */
class BucketPolicyACLGrantMapGrantPermission extends AbstractModel
{
    /** @var int */
    protected $flags = 0;

    /**
     * @return int
     */
    public function getFlags(): int
    {
        return $this->flags;
    }
}
