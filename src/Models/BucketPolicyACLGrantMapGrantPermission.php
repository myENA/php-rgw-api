<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWBucketPolicyACLGrantMapGrantPermission",
 *     type="object",
 *     allOf={
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="flags",
 *                  type="integer"
 *              )
 *          )
 *     }
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
