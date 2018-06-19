<?php declare(strict_types=1);

namespace MyENA\RGW\Chain;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Chain\Bucket\Delete;
use MyENA\RGW\Chain\Bucket\DeleteObject;
use MyENA\RGW\Chain\Bucket\Index;
use MyENA\RGW\Chain\Bucket\Info;
use MyENA\RGW\Chain\Bucket\Link;
use MyENA\RGW\Chain\Bucket\ListBuckets;
use MyENA\RGW\Chain\Bucket\Policy;
use MyENA\RGW\Chain\Bucket\Unlink;
use MyENA\RGW\Links\HeaderLink;
use MyENA\RGW\Links\UriLink;

/**
 * Class BucketRootLink
 * @package MyENA\RGW\Chain
 */
class BucketRootLink extends AbstractLink implements UriLink, HeaderLink
{
    const PATH = '/bucket';

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
     * @param null|string $uid
     * @return \MyENA\RGW\Chain\Bucket\ListBuckets
     */
    public function List(?string $uid = null): ListBuckets
    {
        return ListBuckets::new($this, [ListBuckets::PARAM_UID => $uid]);
    }

    /**
     * @param string $uid
     * @return \MyENA\RGW\Chain\Bucket\Info
     */
    public function Info(string $uid): Info
    {
        return Info::new($this, [Info::PARAM_UID => $uid]);
    }

    /**
     * @param string $bucket
     * @param bool|null $checkObjects
     * @param bool|null $fix
     * @return \MyENA\RGW\Chain\Bucket\Index
     */
    public function Index(string $bucket, ?bool $checkObjects = null, ?bool $fix = null): Index
    {
        return Index::new(
            $this,
            [
                Index::PARAM_BUCKET        => $bucket,
                Index::PARAM_CHECK_OBJECTS => $checkObjects,
                Index::PARAM_FIX           => $fix,
            ]
        );
    }

    /**
     * @param string $uid
     * @param string $bucket
     * @return \MyENA\RGW\Chain\Bucket\Link
     */
    public function Link(string $uid, string $bucket): Link
    {
        return Link::new($this, [Link::PARAM_UID => $uid, Link::PARAM_BUCKET => $bucket]);
    }

    /**
     * @param string $uid
     * @param string $bucket
     * @return \MyENA\RGW\Chain\Bucket\Unlink
     */
    public function Unlink(string $uid, string $bucket): Unlink
    {
        return Unlink::new($this, [Unlink::PARAM_UID => $uid, Unlink::PARAM_BUCKET => $bucket]);
    }

    /**
     * @param string $uid
     * @param string $bucket
     * @return \MyENA\RGW\Chain\Bucket\Policy
     */
    public function Policy(string $uid, string $bucket): Policy
    {
        return Policy::new($this, [Policy::PARAM_UID => $uid, Policy::PARAM_BUCKET => $bucket]);
    }

    /**
     * @param string $bucket
     * @param bool $purgeObjects
     * @return \MyENA\RGW\Chain\Bucket\Delete
     */
    public function Delete(string $bucket, bool $purgeObjects = false): Delete
    {
        return Delete::new(
            $this,
            [
                Delete::PARAM_BUCKET        => $bucket,
                Delete::PARAM_PURGE_OBJECTS => $purgeObjects,
            ]
        );
    }

    /**
     * @param string $bucket
     * @param string $object
     * @return \MyENA\RGW\Chain\Bucket\DeleteObject
     */
    public function DeleteObject(string $bucket, string $object): DeleteObject
    {
        return DeleteObject::new($this, [DeleteObject::PARAM_BUCKET => $bucket, DeleteObject::PARAM_OBJECT => $object]);
    }
}