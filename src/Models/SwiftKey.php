<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWSwiftKey",
 *     @OA\Schema(
 *          type="object"
 *     ),
 *     @OA\Property(
 *          property="user",
 *          @OA\Schema(
 *              type="string"
 *          )
 *     ),
 *     @OA\Property(
 *          property="secret_key",
 *          @OA\Schema(
 *              type="string"
 *          )
 *     )
 * )
 */

/**
 * Class SwiftKey
 * @package MyENA\RGW\Models
 */
class SwiftKey extends AbstractModel
{
    /** @var string */
    protected $user = '';
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
    public function getSecretKey(): string
    {
        return $this->secretKey;
    }
}