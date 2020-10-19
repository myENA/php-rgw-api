<?php declare(strict_types=1);

namespace MyENA\RGW\Chain\User\SubUser;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Links\ExecutableLink;
use MyENA\RGW\Links\MethodLink;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Models\SubUserInfoCollection;
use MyENA\RGW\Parameter;
use MyENA\RGW\Parameter\SingleParameter;
use MyENA\RGW\Validators;

/**
 * Class Modify
 * @package MyENA\RGW\Chain\User\SubUser
 */
class Modify extends AbstractLink implements MethodLink, ParameterLink, ExecutableLink
{
    public const METHOD = 'POST';

    public const PARAM_SUBUSER         = 'subuser';
    public const PARAM_SECRET_KEY      = 'secret-key';
    public const PARAM_KEY_TYPE        = 'key-type';
    public const PARAM_ACCESS          = 'access';
    public const PARAM_GENERATE_SECRET = 'generate-secret';

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
                (new SingleParameter(self::PARAM_SUBUSER, Parameter::IN_QUERY))
                    ->requireValue()
                    ->addValidator(Validators::String()),
                (new SingleParameter(self::PARAM_SECRET_KEY, Parameter::IN_QUERY))
                    ->addValidator(Validators::String()),
                (new SingleParameter(self::PARAM_KEY_TYPE, Parameter::IN_QUERY))
                    ->addValidator(Validators::OneOf('s3', 'swift')),
                (new SingleParameter(self::PARAM_ACCESS, Parameter::IN_QUERY))
                    ->addValidator(Validators::OneOf('read', 'write', 'readwrite', 'full')),
                (new SingleParameter(self::PARAM_GENERATE_SECRET, Parameter::IN_QUERY))
                    ->addValidator(Validators::Boolean())
                    ->setDefaultValue(true),
            ];
        }
        return $this->parameters;
    }

    /**
     * @return array(
     * @type \MyENA\RGW\Models\SubUserInfoCollection|null
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
        return SubUserInfoCollection::fromPSR7Response($resp);
    }
}