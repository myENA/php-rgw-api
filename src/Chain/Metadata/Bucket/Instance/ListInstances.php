<?php declare(strict_types=1);

namespace MyENA\RGW\Chain\Metadata\Bucket\Instance;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Links\ExecutableLink;
use MyENA\RGW\Links\MethodLink;
use function MyENA\RGW\decodeBody;

/**
 * Class ListInstances
 * @package MyENA\RGW\Chain\Metadata\Bucket\Instance
 */
class ListInstances extends AbstractLink implements MethodLink, ExecutableLink
{
    public const METHOD = 'GET';

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        return self::METHOD;
    }

    /**
     * @return array(
     * @type string[]|null
     * @type \MyENA\RGW\Error|null
     * )
     */
    public function execute(): array
    {
        /** @var \Psr\Http\Message\ResponseInterface $resp */
        /** @var \MyENA\RGW\Error $err */
        [$resp, $err] = $this->client->do($this->buildRequest());
        if (null !== $err) {
            return [null, $err];
        }
        return decodeBody($resp, true);
    }
}