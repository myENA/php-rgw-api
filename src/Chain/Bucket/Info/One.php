<?php declare(strict_types=1);

namespace MyENA\RGW\Chain\Bucket\Info;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Links\ExecutableLink;
use MyENA\RGW\Links\MethodLink;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Models\BucketInfoCollection;
use MyENA\RGW\Parameter;
use MyENA\RGW\Parameter\SingleParameter;
use MyENA\RGW\Validators;

/**
 * Class One
 * @package MyENA\RGW\Chain\Bucket\Info
 */
class One extends AbstractLink implements MethodLink, ParameterLink, ExecutableLink
{
    const METHOD = 'GET';

    const PARAM_BUCKET = 'bucket';

    /** @var \MyENA\RGW\Parameter[] */
    private $parameters;

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        return self::METHOD;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        if (!isset($this->parameters)) {
            $this->parameters = [
                (new SingleParameter(self::PARAM_BUCKET, Parameter::IN_QUERY))
                    ->requireValue()
                    ->addValidator(Validators::BucketName()),
            ];
        }
        return $this->parameters;
    }

    /**
     * @return array(
     * @type \MyENA\RGW\Models\BucketInfo|null
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
        /** @var \MyENA\RGW\Models\BucketInfoCollection $c */
        /** @var \MyENA\RGW\Error $err */
        [$c, $err] = BucketInfoCollection::fromPSR7Response($resp);
        if (null !== $err) {
            return [null, $err];
        }
        return [$c->first(), null];
    }
}