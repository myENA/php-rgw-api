<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWBucketPolicyACL",
 *     type="object",
 *     @OA\Property(
 *          property="acl_group_map",
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/RGWBucketPolicyACLGroupMap")
 *     ),
 *     @OA\Property(
 *          property="acl_user_map",
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/RGWBucketPolicyACLUserMap")
 *     ),
 *     @OA\Property(
 *          property="grant_map",
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/RGWBucketPolicyACLGrantMap")
 *     )
 * )
 */

/**
 * Class BucketPolicyACL
 * @package MyENA\RGW\Models
 */
class BucketPolicyACL extends AbstractModel
{
    /** @var \MyENA\RGW\Models\BucketPolicyACLGroupMap[] */
    protected $aclGroupMap = [];
    /** @var \MyENA\RGW\Models\BucketPolicyACLUserMap[] */
    protected $aclUserMap = [];
    /** @var \MyENA\RGW\Models\BucketPolicyACLGrantMap[] */
    protected $grantMap = [];

    /**
     * BucketPolicyACL constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        foreach ($this->aclGroupMap as &$aclGroupMap) {
            $aclGroupMap = new BucketPolicyACLGroupMap($aclGroupMap);
        }
        foreach ($this->aclUserMap as &$aclUserMap) {
            $aclUserMap = new BucketPolicyACLUserMap($aclUserMap);
        }
        foreach ($this->grantMap as &$grantMap) {
            $grantMap = new BucketPolicyACLGrantMap($grantMap);
        }
    }

    /**
     * @return \MyENA\RGW\Models\BucketPolicyACLGroupMap[]
     */
    public function getAclGroupMap(): array
    {
        return $this->aclGroupMap;
    }

    /**
     * @return \MyENA\RGW\Models\BucketPolicyACLUserMap[]
     */
    public function getAclUserMap(): array
    {
        return $this->aclUserMap;
    }

    /**
     * @return \MyENA\RGW\Models\BucketPolicyACLGrantMap[]
     */
    public function getGrantMap(): array
    {
        return $this->grantMap;
    }
}