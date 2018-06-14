<?php namespace MyENA\RGW\Chain\Metadata\Bucket\Instance;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Links\ExecutableLink;
use MyENA\RGW\Links\MethodLink;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Models\MetadataBucketInstanceResponse;
use MyENA\RGW\Parameter;
use MyENA\RGW\Parameter\SingleParameter;
use MyENA\RGW\Validators;

/**
 * Class Info
 * @package MyENA\RGW\Chain\Metadata\Bucket\Instance
 */
class Info extends AbstractLink implements MethodLink, ParameterLink, ExecutableLink {
    const METHOD = 'GET';

    const PARAM_BUCKET = 'key';

    /** @var \MyENA\RGW\Parameter[] */
    private $parameters;

    /**
     * @return string
     */
    public function getRequestMethod(): string {
        return self::METHOD;
    }

    /**
     * @return \MyENA\RGW\Parameter[]
     */
    public function getParameters(): array {
        if (!isset($this->parameters)) {
            $this->parameters = [
                (new SingleParameter(self::PARAM_BUCKET, Parameter::IN_QUERY))
                    ->required()
                    ->addValidator(Validators::String()),
            ];
        }
        return $this->parameters;
    }

    /**
     * @return array(
     * @type \MyENA\RGW\Models\MetadataBucketInstanceResponse|null
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
        return MetadataBucketInstanceResponse::fromPSR7Response($resp);
    }
}