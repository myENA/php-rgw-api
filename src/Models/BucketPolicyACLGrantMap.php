<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWBucketPolicyACLGrantMap",
 *     @OA\Schema(
 *          type="object"
 *     ),
 *     @OA\Property(
 *          property="id",
 *          @OA\Schema(
 *              type="string"
 *          )
 *     ),
 *     @OA\Property(
 *          property="grant",
 *          @OA\Schema(
 *              type="RGWBucketPolicyACLGrantMapGrant"
 *          }
 *     )
 * )
 */

/**
 * Class BucketPolicyACLGrantMap
 * @package MyENA\RGW\Models
 */
class BucketPolicyACLGrantMap extends AbstractModel
{
    /** @var string */
    protected $id = '';
    /** @var \MyENA\RGW\Models\BucketPolicyACLGrantMapGrant */
    protected $grant = null;

    /**
     * BucketPolicyACLGrantMap constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (is_array($this->grant)) {
            $this->grant = new BucketPolicyACLGrantMapGrant($this->grant);
        }
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return \MyENA\RGW\Models\BucketPolicyACLGrantMapGrant
     */
    public function getGrant(): ?BucketPolicyACLGrantMapGrant
    {
        return $this->grant;
    }
}