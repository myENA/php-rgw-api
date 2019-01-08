<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWBucketPolicyOwner",
 *     type="object",
 *     allOf={
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="display_name",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="id",
 *                  type="string"
 *              )
 *          )
 *      }
 * )
 */

/**
 * Class BucketPolicyOwner
 * @package MyENA\RGW\Models
 */
class BucketPolicyOwner extends AbstractModel
{
    /** @var string */
    protected $displayName = '';
    /** @var string */
    protected $id = '';

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->displayName;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}