<?php declare(strict_types=1);

namespace MyENA\RGW\Chain\User\Quota;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Links\ExecutableLink;
use MyENA\RGW\Links\MethodLink;
use MyENA\RGW\Models\Quotas;

/**
 * Class All
 * @package MyENA\RGW\Chain\User\Quota
 */
class All extends AbstractLink implements MethodLink, ExecutableLink
{
    const METHOD = 'GET';

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        return self::METHOD;
    }

    /**
     * @return array(
     * @type \MyENA\RGW\Models\Quotas|null
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
        return Quotas::fromPSR7Response($resp);
    }
}