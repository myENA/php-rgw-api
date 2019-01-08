<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWUserInfo",
 *     type="object",
 *     @OA\Property(
 *          property="tenant",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="user_id",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="display_name",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="email",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="suspended",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="max_buckets",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="subusers",
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/RGWSubUserInfo")
 *     ),
 *     @OA\Property(
 *          property="keys",
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/RGWUserKey")
 *     ),
 *     @OA\Property(
 *          property="swift_keys",
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/RGWSwiftKey")
 *     ),
 *     @OA\Property(
 *          property="caps",
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/RGWUserCapability")
 *     ),
 *     @OA\Property(
 *          property="stats",
 *          type="object",
 *          ref="#/components/schemas/RGWStatisticsEntry"
 *     )
 * )
 */

/**
 * Class UserInfo
 * @package MyENA\RGW\Models
 */
class UserInfo extends AbstractModel
{
    /** @var string */
    protected $tenant = '';
    /** @var string */
    protected $userId = '';
    /** @var string */
    protected $displayName = '';
    /** @var string */
    protected $email = '';
    /** @var int */
    protected $suspended = 0;
    /** @var int */
    protected $maxBuckets = 0;
    /** @var \MyENA\RGW\Models\SubUserInfo[] */
    protected $subusers = [];
    /** @var \MyENA\RGW\Models\UserKey[] */
    protected $keys = [];
    /** @var \MyENA\RGW\Models\SwiftKey[] */
    protected $swiftKeys = [];
    /** @var \MyENA\RGW\Models\UserCapability[] */
    protected $caps = [];
    /** @var \MyENA\RGW\Models\StatisticsEntry */
    protected $stats = null;

    /**
     * UserInfoResponse constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        foreach ($this->subusers as &$subUser) {
            $subUser = new SubUserInfo($subUser);
        }
        foreach ($this->keys as &$key) {
            $key = new UserKey($key);
        }
        foreach ($this->swiftKeys as &$swiftKey) {
            $swiftKey = new SwiftKey($swiftKey);
        }
        foreach ($this->caps as &$cap) {
            $cap = new UserCapability($cap);
        }
        if (is_array($this->stats)) {
            $this->stats = new StatisticsEntry($this->stats);
        }
    }

    /**
     * @return string
     */
    public function getTenant(): string
    {
        return $this->tenant;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

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
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getSuspended(): int
    {
        return $this->suspended;
    }

    /**
     * @return int
     */
    public function getMaxBuckets(): int
    {
        return $this->maxBuckets;
    }

    /**
     * @return \MyENA\RGW\Models\SubUserInfo[]
     */
    public function getSubusers(): array
    {
        return $this->subusers;
    }

    /**
     * @return \MyENA\RGW\Models\UserKey[]
     */
    public function getKeys(): array
    {
        return $this->keys;
    }

    /**
     * @return \MyENA\RGW\Models\SwiftKey[]
     */
    public function getSwiftKeys(): array
    {
        return $this->swiftKeys;
    }

    /**
     * @return \MyENA\RGW\Models\UserCapability[]
     */
    public function getCaps(): array
    {
        return $this->caps;
    }

    /**
     * @return \MyENA\RGW\Models\StatisticsEntry
     */
    public function getStats(): ?StatisticsEntry
    {
        return $this->stats;
    }
}