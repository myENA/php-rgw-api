<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWBucketPolicyOwner",
 *     @OA\Schema(
 *          type="object"
 *     ),
 *     @OA\Property(
 *          property="display_name",
 *          @OA\Schema(
 *              type="string"
 *          )
 *     ),
 *     @OA\Property(
 *          property="id",
 *          @OA\Schema(
 *              type="string"
 *          )
 *     )
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