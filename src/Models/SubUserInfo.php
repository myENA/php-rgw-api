<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWSubUserInfo",
 *     type="object",
 *     @OA\Schema(
 *         @OA\Property(
 *             property="id",
 *             type="string"
 *         ),
 *         @OA\Property(
 *             property="permissions",
 *             type="string"
 *         )
 *     )
 * )
 */

/**
 * Class SubUserInfo
 * @package MyENA\RGW\Models
 */
class SubUserInfo extends AbstractModel
{
    /** @var string */
    protected $id = '';
    /** @var string */
    protected $permissions = '';

    /**
     * @return string
     */
    public function getPermissions(): string
    {
        return $this->permissions;
    }

    /**
     * @param string $permissions
     */
    public function setPermissions(string $permissions): void
    {
        $this->permissions = $permissions;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getId();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }
}