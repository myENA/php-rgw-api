<?php declare(strict_types=1);

namespace MyENA\RGW\Chain\User\Quota;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Links\ExecutableLink;
use MyENA\RGW\Links\MethodLink;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Parameter;
use MyENA\RGW\Parameter\SingleParameter;
use MyENA\RGW\Validators;

/**
 * Class Set
 * @package MyENA\RGW\Chain\User\Quota
 */
class Set extends AbstractLink implements MethodLink, ParameterLink, ExecutableLink
{
    const METHOD = 'PUT';

    const PARAM_QUOTA_TYPE  = 'quota-type';
    const PARAM_MAX_OBJECTS = 'max-objects';
    const PARAM_MAX_SIZE_KB = 'max-size-kb';
    const PARAM_ENABLED     = 'enabled';

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
                (new SingleParameter(self::PARAM_QUOTA_TYPE, Parameter::IN_QUERY))
                    ->requireValue()
                    ->addValidator(Validators::OneOf('user', 'bucket')),
                (new SingleParameter(self::PARAM_MAX_OBJECTS, Parameter::IN_QUERY))
                    ->addValidator(Validators::Integer()),
                (new SingleParameter(self::PARAM_MAX_SIZE_KB, Parameter::IN_QUERY))
                    ->addValidator(Validators::Integer()),
                (new SingleParameter(self::PARAM_ENABLED, Parameter::IN_QUERY))
                    ->addValidator(Validators::Boolean()),
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