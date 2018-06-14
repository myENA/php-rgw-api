<?php namespace MyENA\RGW\Chain\Metadata\Bucket;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Chain\Metadata\Bucket\Instance\Info as InstanceInfo;
use MyENA\RGW\Chain\Metadata\Bucket\Instance\ListInstances;
use MyENA\RGW\Links\UriLink;

/**
 * Class Instance
 * @package MyENA\RGW\Chain\Metadata\Bucket
 */
class Instance extends AbstractLink implements UriLink {
    const PATH = '.instance';

    /**
     * @return string
     */
    public function getUriPart(): string {
        return self::PATH;
    }

    /**
     * @return \MyENA\RGW\Chain\Metadata\Bucket\Instance\ListInstances
     */
    public function List(): ListInstances {
        return ListInstances::new($this);
    }

    /**
     * @param string $bucket
     * @return \MyENA\RGW\Chain\Metadata\Bucket\Instance\Info
     */
    public function Info(string $bucket): InstanceInfo {
        return InstanceInfo::new($this, [InstanceInfo::PARAM_BUCKET => $bucket]);
    }
}