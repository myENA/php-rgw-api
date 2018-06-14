<?php namespace MyENA\RGW\Chain\User;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Chain\User\Key\Create as KeyCreate;
use MyENA\RGW\Chain\User\Key\Delete as KeyDelete;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Parameter\EmptyParameter;

/**
 * Class Key
 * @package MyENA\RGW\Chain\User
 */
class Key extends AbstractLink implements ParameterLink {
    /** @var \MyENA\RGW\Parameter[] */
    private $parameters;

    /**
     * @return \MyENA\RGW\Parameter[]
     */
    public function getParameters(): array {
        if (!isset($this->parameters)) {
            $this->parameters = [
                new EmptyParameter('key'),
            ];
        }
        return $this->parameters;
    }

    /**
     * @param string $uid
     * @param bool   $generateKey
     * @param array  $optional
     * @return \MyENA\RGW\Chain\User\Key\Create
     */
    public function Create(string $uid, bool $generateKey = true, array $optional = []): KeyCreate {
        return KeyCreate::new($this,
            [KeyCreate::PARAM_UID => $uid, KeyCreate::PARAM_GENERATE_KEY => $generateKey] + $optional);
    }

    /**
     * @param string $accessKey
     * @param array  $optional
     * @return \MyENA\RGW\Chain\User\Key\Delete
     */
    public function Delete(string $accessKey, array $optional = []): KeyDelete {
        return KeyDelete::new($this, [KeyDelete::PARAM_ACCESS_KEY => $accessKey] + $optional);
    }
}