<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @SWG\Definition(
 *     definition="RGWSwiftKey",
 *     type="object",
 *     @SWG\Property(
 *          property="user",
 *          type="string"
 *     ),
 *     @SWG\Property(
 *          property="secret_key",
 *          type="string"
 *     )
 * )
 */

/**
 * Class SwiftKey
 * @package MyENA\RGW\Models
 */
class SwiftKey extends AbstractModel {
    /** @var string */
    protected $user = '';
    /** @var string */
    protected $secretKey = '';

    /**
     * @return string
     */
    public function getUser(): string {
        return $this->user;
    }

    /**
     * @return string
     */
    public function getSecretKey(): string {
        return $this->secretKey;
    }
}