<?php namespace MyENA\RGW\Chain\Metadata\Bucket;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Links\ExecutableLink;
use MyENA\RGW\Links\MethodLink;
use function MyENA\RGW\decodeBody;

/**
 * Class ListBuckets
 * @package MyENA\RGW\Chain\Metadata\Bucket
 */
class ListBuckets extends AbstractLink implements MethodLink, ExecutableLink {
    const METHOD = 'GET';

    /**
     * @return string
     */
    public function getRequestMethod(): string {
        return self::METHOD;
    }

    /**
     * @return array(
     * @type string[]|null List of bucket names
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
        return decodeBody($resp);
    }
}