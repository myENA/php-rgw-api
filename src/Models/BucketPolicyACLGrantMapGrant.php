<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @SWG\Definition(
 *     definition="RGWBucketPolicyACLGrantMapGrant",
 *     type="object",
 *     @SWG\Property(
 *          property="name",
 *          type="string"
 *     ),
 *     @SWG\Property(
 *          property="permission",
 *          type="object",
 *          ref="#/definitions/RGWBucketPolicyACLGrantMapGrantPermission"
 *     ),
 *     @SWG\Property(
 *          property="type",
 *          type="object",
 *          ref="#/definitions/RGWBucketPolicyACLGrantMapGrantType"
 *     ),
 *     @SWG\Property(
 *          property="email",
 *          type="string"
 *     ),
 *     @SWG\Property(
 *          property="id",
 *          type="string"
 *     ),
 *     @SWG\Property(
 *          property="group",
 *          type="integer"
 *     ),
 *     @SWG\Property(
 *          property="url_spec",
 *          type="string"
 *     )
 * )
 */

/**
 * Class BucketPolicyACLGrantMapGrant
 * @package MyENA\RGW\Models
 */
class BucketPolicyACLGrantMapGrant extends AbstractModel
{
    /** @var string */
    protected $name = '';
    /** @var \MyENA\RGW\Models\BucketPolicyACLGrantMapGrantPermission */
    protected $permission = null;
    /** @var \MyENA\RGW\Models\BucketPolicyACLGrantMapGrantType */
    protected $type = null;
    /** @var string */
    protected $email = '';
    /** @var string */
    protected $id = '';
    /** @var int */
    protected $group = 0;
    /** @var string */
    protected $urlSpec = '';

    /**
     * BucketPolicyACLGrantMapGrant constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (is_array($this->permission)) {
            $this->permission = new BucketPolicyACLGrantMapGrantPermission($this->permission);
        }
        if (is_array($this->type)) {
            $this->type = new BucketPolicyACLGrantMapGrantType($this->type);
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return \MyENA\RGW\Models\BucketPolicyACLGrantMapGrantPermission
     */
    public function getPermission(): ?BucketPolicyACLGrantMapGrantPermission
    {
        return $this->permission;
    }

    /**
     * @return \MyENA\RGW\Models\BucketPolicyACLGrantMapGrantType
     */
    public function getType(): ?BucketPolicyACLGrantMapGrantType
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getGroup(): int
    {
        return $this->group;
    }

    /**
     * @return string
     */
    public function getUrlSpec(): string
    {
        return $this->urlSpec;
    }
}