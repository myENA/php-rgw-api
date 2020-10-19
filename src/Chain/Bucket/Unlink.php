<?php declare(strict_types=1);

namespace MyENA\RGW\Chain\Bucket;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Links\ExecutableLink;
use MyENA\RGW\Links\MethodLink;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Parameter;
use MyENA\RGW\Parameter\SingleParameter;
use MyENA\RGW\Validators;

/**
 * Class Unlink
 * @package MyENA\RGW\Chain\Bucket
 */
class Unlink extends AbstractLink implements MethodLink, ParameterLink, ExecutableLink
{
    public const METHOD = 'PUT';

    public const PARAM_UID    = 'uid';
    public const PARAM_BUCKET = 'bucket';

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
                (new SingleParameter(self::PARAM_UID, Parameter::IN_QUERY))
                    ->requireValue()
                    ->addValidator(Validators::String()),
                (new SingleParameter(self::PARAM_BUCKET, Parameter::IN_QUERY))
                    ->requireValue()
                    ->addValidator(Validators::BucketName()),
            ];
        }
        return $this->parameters;
    }

    /**
     * @return array(
     * @type null Returns no value
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