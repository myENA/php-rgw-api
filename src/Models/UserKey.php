<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWUserKey",
 *     type="object",
 *     @OA\Schema(
 *         @OA\Property(
 *             property="user",
 *             type="string"
 *          ),
 *         @OA\Property(
 *             property="access_key",
 *             type="string"
 *         ),
 *         @OA\Property(
 *             property="secret_key",
 *             type="string"
 *         )
 *     )
 * )
 */

/**
 * Class UserKey
 * @package MyENA\RGW\Models
 */
class UserKey extends AbstractModel
{
    /** @var string */
    protected $user = '';
    /** @var string */
    protected $accessKey = '';
    /** @var string */
    protected $secretKey = '';

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getAccessKey(): string
    {
        return $this->accessKey;
    }

    /**
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->secretKey;
    }
}