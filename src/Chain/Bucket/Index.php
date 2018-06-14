<?php namespace MyENA\RGW\Chain\Bucket;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Links\ExecutableLink;
use MyENA\RGW\Links\MethodLink;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Models\BucketIndex;
use MyENA\RGW\Parameter;
use MyENA\RGW\Validators;

/**
 * Class Index
 * @package MyENA\RGW\Chain\Bucket
 */
class Index extends AbstractLink implements MethodLink, ParameterLink, ExecutableLink {
    const METHOD = 'GET';

    const PARAM_BUCKET        = 'bucket';
    const PARAM_CHECK_OBJECTS = 'check-objects';
    const PARAM_FIX           = 'fix';

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
                new Parameter\EmptyParameter('index'),
                (new Parameter\SingleParameter(self::PARAM_BUCKET, Parameter::IN_QUERY))
                    ->required()
                    ->addValidator(Validators::BucketName()),
                (new Parameter\SingleParameter(self::PARAM_CHECK_OBJECTS, Parameter::IN_QUERY))
                    ->addValidator(Validators::Boolean()),
                (new Parameter\SingleParameter(self::PARAM_FIX, Parameter::IN_QUERY))
                    ->addValidator(Validators::Boolean()),
            ];
        }
        return $this->parameters;
    }

    /**
     * @return array(
     * @type \MyENA\RGW\Models\BucketIndex|null
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
        return BucketIndex::fromPSR7Response($resp);
    }
}