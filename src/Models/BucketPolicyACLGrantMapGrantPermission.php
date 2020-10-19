<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="RGWBucketPolicyACLGrantMapGrantPermission",
 *     type="object",
 *     @OA\Property(
 *          property="flags",
 *          type="integer"
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
