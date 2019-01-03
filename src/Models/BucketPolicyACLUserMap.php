<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWBucketPolicyACLUserMap",
 *     type="object",
 *     @OA\Property(
 *          property="acl",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="user",
 *          type="string"
 *     )
 * )
 */

/**
 * Class BucketPolicyACLUserMap
 * @package MyENA\RGW\Models
 */
class BucketPolicyACLUserMap extends AbstractModel
{
    /** @var string */
    protected $acl = '';
    /** @var string */
    protected $user = '';

    /**
     * @return string
     */
    public function getAcl(): string
    {
        return $this->acl;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }
}