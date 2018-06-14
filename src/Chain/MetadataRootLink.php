<?php namespace MyENA\RGW\Chain;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Chain\Metadata\Bucket;
use MyENA\RGW\Chain\Metadata\User;
use MyENA\RGW\Links\HeaderLink;
use MyENA\RGW\Links\UriLink;

/**
 * Class MetadataRootLink
 * @package MyENA\RGW\Chain
 */
class MetadataRootLink extends AbstractLink implements UriLink, HeaderLink {
    const PATH = '/metadata';

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }

    /**
     * @return array
     */
    public function getRequestHeaders(): array {
        return RGW_DEFAULT_REQUEST_HEADERS;
    }

    /**
     * @return \MyENA\RGW\Chain\Metadata\User
     */
    public function User(): User {
        return User::new($this);
    }

    /**
     * @return \MyENA\RGW\Chain\Metadata\Bucket
     */
    public function Bucket(): Bucket {
        return Bucket::new($this);
    }
}