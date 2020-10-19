<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="RGWSwiftKey",
 *     type="object",
 *     @OA\Property(
 *          property="user",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="secret_key",
 *          type="string"
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