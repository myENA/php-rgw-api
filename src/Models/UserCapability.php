<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="RGWUserCapability",
 *     type="object",
 *     @OA\Property(
 *          property="type",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="perm",
 *          type="string"
 *     )
 * )
 */

/**
 * Class UserCapability
 * @package MyENA\RGW\Models
 */
class UserCapability extends AbstractModel
{

    public const KEY_TYPE = 'type';
    public const KEY_PERM = 'perm';

    public const TYPE_USERS    = 'users';
    public const TYPE_BUCKETS  = 'buckets';
    public const TYPE_METADATA = 'metadata';
    public const TYPE_USAGE    = 'usage';
    public const TYPE_ZONE     = 'zone';

    public const PERM_ALL        = '*';
    public const PERM_READ       = 'read';
    public const PERM_WRITE      = 'write';
    public const PERM_READ_WRITE = 'read,write';

    /** @var string */
    protected $type;
    /** @var string */
    protected $permission;

    /**
     * UserCapability constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->type = $data['type'] ?? '';
        if (isset($data['permission'])) {
            $this->permission = $data['permission'];
        } elseif (isset($data['perm'])) {
            $this->permission = $data['perm'];
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "{$this->getType()}={$this->getPermission()}";
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getPermission(): string
    {
        return $this->permission ?? '';
    }

    /**
     * @param string $permission
     */
    public function setPermission(string $permission): void
    {
        $this->permission = $permission;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            self::KEY_TYPE => $this->getType(),
            self::KEY_PERM => $this->getPermission(),
        ];
    }
}