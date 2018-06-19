<?php declare(strict_types=1);

namespace MyENA\RGW\Chain\User\Key;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Links\ExecutableLink;
use MyENA\RGW\Links\MethodLink;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Parameter;
use MyENA\RGW\Parameter\SingleParameter;
use MyENA\RGW\Validators;

/**
 * Class Delete
 * @package MyENA\RGW\Chain\User\Key
 */
class Delete extends AbstractLink implements MethodLink, ParameterLink, ExecutableLink
{
    const METHOD = 'DELETE';

    const PARAM_ACCESS_KEY = 'access-key';
    const PARAM_UID        = 'uid';
    const PARAM_SUBUSER    = 'subuser';
    const PARAM_KEY_TYPE   = 'key-type';

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
                (new SingleParameter(self::PARAM_ACCESS_KEY, Parameter::IN_QUERY))
                    ->requireValue()
                    ->addValidator(Validators::String()),
                (new SingleParameter(self::PARAM_UID, Parameter::IN_QUERY))
                    ->addValidator(Validators::String()),
                (new SingleParameter(self::PARAM_SUBUSER, Parameter::IN_QUERY))
                    ->addValidator(Validators::String()),
                (new SingleParameter(self::PARAM_KEY_TYPE, Parameter::IN_QUERY))
                    ->addValidator(Validators::OneOf('s3', 'swift')),
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