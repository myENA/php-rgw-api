<?php namespace MyENA\RGW\Chain\Bucket\Info;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Links\ExecutableLink;
use MyENA\RGW\Links\MethodLink;
use MyENA\RGW\Models\BucketInfoCollection;

/**
 * Class All
 * @package MyENA\RGW\Chain\Bucket\Info
 */
class All extends AbstractLink implements MethodLink, ExecutableLink {
    const METHOD = 'GET';

    /**
     * @return string
     */
    public function getRequestMethod(): string {
        return self::METHOD;
    }

    /**
     * @return array(
     * @type \MyENA\RGW\Models\BucketInfoCollection|null
     * @type \MyENA\RGW\Error|null
     * )
     */
    public function execute(): array {
        /** @var \Psr\Http\Message\ResponseInterface $resp */
        /** @var \MyENA\RGW\Error $err */
        [$resp, $err] = $this->client->do($this->buildRequest());
        if (null !== $err) {
            return [null, $err];
        }
        return BucketInfoCollection::fromPSR7Response($resp);
    }
}