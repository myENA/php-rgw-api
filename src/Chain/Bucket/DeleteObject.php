<?php declare(strict_types=1);

namespace MyENA\RGW\Chain\Bucket;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Links\ExecutableLink;
use MyENA\RGW\Links\MethodLink;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Parameter;
use MyENA\RGW\Parameter\EmptyParameter;
use MyENA\RGW\Parameter\SingleParameter;
use MyENA\RGW\Validators;

/**
 * Class DeleteObject
 * @package MyENA\RGW\Chain\Bucket
 */
class DeleteObject extends AbstractLink implements MethodLink, ParameterLink, ExecutableLink
{
    const METHOD = 'DELETE';

    const PARAM_BUCKET = 'bucket';
    const PARAM_OBJECT = 'object';

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
     * @return \MyENA\RGW\Parameter[]
     */
    public function getParameters(): array
    {
        if (!isset($this->parameters)) {
            $this->parameters = [
                new EmptyParameter('object'),
                (new SingleParameter(self::PARAM_BUCKET, Parameter::IN_QUERY))
                    ->requireValue()
                    ->addValidator(Validators::BucketName()),
                (new SingleParameter(self::PARAM_OBJECT, Parameter::IN_QUERY))
                    ->requireValue()
                    ->addValidator(Validators::String()),
            ];
        }
        return $this->parameters;
    }

    /**
     * @return array(
     * @type null Response is empty
     * @type \MyENA\RGW\Error|null
     * )
     */
    public function execute(): array
    {
        /** @var \Psr\Http\Message\ResponseInterface $resp */
        /** @var \MyENA\RGW\Error $err */
        [$_, $err] = $this->client->do($this->buildRequest());
        return [null, $err];
    }
}