<?php declare(strict_types=1);

namespace MyENA\RGW\Chain;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Chain\User\Capabilities;
use MyENA\RGW\Chain\User\Create;
use MyENA\RGW\Chain\User\Delete;
use MyENA\RGW\Chain\User\Info;
use MyENA\RGW\Chain\User\Key;
use MyENA\RGW\Chain\User\Modify;
use MyENA\RGW\Chain\User\Quota;
use MyENA\RGW\Chain\User\SubUser;
use MyENA\RGW\Links\HeaderLink;
use MyENA\RGW\Links\UriLink;

/**
 * Class User
 * @package MyENA\RGW\Chain
 */
class UserRootLink extends AbstractLink implements UriLink, HeaderLink
{
    public const PATH = '/user';

    /**
     * @return string
     */
    public function getUriPart(): string
    {
        return self::PATH;
    }

    /**
     * @return array
     */
    public function getRequestHeaders(): array
    {
        return RGW_DEFAULT_REQUEST_HEADERS;
    }

    /**
     * @param string $uid
     * @param string $displayName
     * @param array $optional
     * @return \MyENA\RGW\Chain\User\Create
     */
    public function Create(string $uid, string $displayName, array $optional = []): Create
    {
        return Create::new(
            $this,
            [
                Create::PARAM_UID          => $uid,
                Create::PARAM_DISPLAY_NAME => $displayName,
            ] + $optional
        );
    }

    /**
     * @param string $uid
     * @param bool $purgeData
     * @return \MyENA\RGW\Chain\User\Delete
     */
    public function Delete(string $uid, ?bool $purgeData = null): Delete
    {
        return Delete::new($this, [Delete::PARAM_UID => $uid, Delete::PARAM_PURGE_DATA => $purgeData]);
    }

    /**
     * @param string $uid
     * @param bool $stats
     * @return \MyENA\RGW\Chain\User\Info
     */
    public function Info(string $uid, ?bool $stats = null): Info
    {
        return Info::new($this, [Info::PARAM_UID => $uid, Info::PARAM_STATS => $stats]);
    }

    /**
     * @param string $uid
     * @param array $optional
     * @return \MyENA\RGW\Chain\User\Modify
     */
    public function Modify(string $uid, array $optional = []): Modify
    {
        return Modify::new($this, [Modify::PARAM_UID => $uid] + $optional);
    }

    /**
     * @param string $uid
     * @return \MyENA\RGW\Chain\User\Quota
     */
    public function Quota(string $uid): Quota
    {
        return Quota::new($this, [Quota::PARAM_UID => $uid]);
    }

    /**
     * @param string $uid
     * @return \MyENA\RGW\Chain\User\SubUser
     */
    public function SubUser(string $uid): SubUser
    {
        return SubUser::new($this, [SubUser::PARAM_UID => $uid]);
    }

    /**
     * @param string $uid
     * @return \MyENA\RGW\Chain\User\Capabilities
     */
    public function Capabilities(string $uid): Capabilities
    {
        return Capabilities::new($this, [Capabilities::PARAM_UID => $uid]);
    }

    /**
     * @return \MyENA\RGW\Chain\User\Key
     */
    public function Key(): Key
    {
        return Key::new($this);
    }
}
