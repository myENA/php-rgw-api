<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWBucketPolicyACLGroupMap",
 *     type="object",
 *     allOf={
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="acl",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="group",
 *                  type="string"
 *              )
 *          )
 *      }
 * )
 */

/**
 * Class BucketPolicyACLGroupMap
 * @package MyENA\RGW\Models
 */
class BucketPolicyACLGroupMap extends AbstractModel
{
    /** @var string */
    protected $acl = '';
    /** @var string */
    protected $group = '';

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
    public function getGroup(): string
    {
        return $this->group;
    }
}