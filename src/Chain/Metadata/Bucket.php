<?php declare(strict_types=1);

namespace MyENA\RGW\Chain\Metadata;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Chain\Metadata\Bucket\Info;
use MyENA\RGW\Chain\Metadata\Bucket\Instance;
use MyENA\RGW\Chain\Metadata\Bucket\ListBuckets;
use MyENA\RGW\Links\UriLink;

/**
 * Class Bucket
 * @package MyENA\RGW\Chain\Metadata
 */
class Bucket extends AbstractLink implements UriLink
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
     * @return \MyENA\RGW\Chain\Metadata\Bucket\ListBuckets
     */
    public function List(): ListBuckets
    {
        return ListBuckets::new($this);
    }

    /**
     * @param string $bucket
     * @return \MyENA\RGW\Chain\Metadata\Bucket\Info
     */
    public function Info(string $bucket): Info
    {
        return Info::new($this, [Info::PARAM_BUCKET => $bucket]);
    }

    /**
     * @return \MyENA\RGW\Chain\Metadata\Bucket\Instance
     */
    public function Instance(): Instance
    {
        return Instance::new($this);
    }
}