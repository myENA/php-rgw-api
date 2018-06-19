<?php declare(strict_types=1);

namespace MyENA\RGW\Chain\Metadata;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Chain\Metadata\User\Info;
use MyENA\RGW\Chain\Metadata\User\ListUsers;
use MyENA\RGW\Links\UriLink;

/**
 * Class User
 * @package MyENA\RGW\Chain\Metadata
 */
class User extends AbstractLink implements UriLink
{
    const PATH = '/user';

    /**
     * @return string
     */
    public function getUriPart(): string
    {
        return self::PATH;
    }

    /**
     * @return \MyENA\RGW\Chain\Metadata\User\ListUsers
     */
    public function List(): ListUsers
    {
        return ListUsers::new($this);
    }

    /**
     * @param string $uid
     * @return \MyENA\RGW\Chain\Metadata\User\Info
     */
    public function Info(string $uid): Info
    {
        return Info::new($this, [Info::PARAM_UID => $uid]);
    }
}