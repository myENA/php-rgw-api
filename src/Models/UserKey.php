<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @SWG\Definition(
 *     definition="RGWUserKey",
 *     type="object",
 *     @SWG\Property(
 *          property="user",
 *          type="string"
 *     ),
 *     @SWG\Property(
 *          property="access_key",
 *          type="string"
 *     ),
 *     @SWG\Property(
 *          property="secret_key",
 *          type="string"
 *     )
 * )
 */

/**
 * Class UserKey
 * @package MyENA\RGW\Models
 */
class UserKey extends AbstractModel {
    /** @var string */
    protected $user = '';
    /** @var string */
    protected $accessKey = '';
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
    public function getAccessKey(): string {
        return $this->accessKey;
    }

    /**
     * @return string
     */
    public function getSecretKey(): string {
        return $this->secretKey;
    }
}