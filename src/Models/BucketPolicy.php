<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWBucketPolicy",
 *     @OA\Schema(
 *          type="object"
 *     ),
 *     @OA\Property(
 *          property="owner",
 *          @OA\Schema(
 *              type="object"
 *          ),
 *          ref="#/components/schemas/RGWBucketPolicyOwner"
 *     ),
 *     @OA\Property(
 *          property="acl",
 *          @OA\Schema(
 *              type="object"
 *          ),
 *          ref="#/components/schemas/RGWBucketPolicyACL"
 *     )
 * )
 */

/**
 * Class BucketPolicy
 * @package MyENA\RGW\Models
 */
class BucketPolicy extends AbstractModel
{
    /** @var \MyENA\RGW\Models\BucketPolicyOwner */
    protected $owner = null;
    /** @var \MyENA\RGW\Models\BucketPolicyACL */
    protected $acl = null;

    /**
     * BucketPolicyResponse constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (is_array($this->owner)) {
            $this->owner = new BucketPolicyOwner($this->owner);
        }
        if (is_array($this->acl)) {
            $this->acl = new BucketPolicyACL($this->acl);
        }
    }

    /**
     * @return \MyENA\RGW\Models\BucketPolicyOwner
     */
    public function getOwner(): ?BucketPolicyOwner
    {
        return $this->owner;
    }

    /**
     * @return \MyENA\RGW\Models\BucketPolicyACL
     */
    public function getAcl(): ?BucketPolicyACL
    {
        return $this->acl;
    }
}