<?php namespace MyENA\RGW\Chain\User\Key;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Links\ExecutableLink;
use MyENA\RGW\Links\MethodLink;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Models\UserKeyCollection;
use MyENA\RGW\Parameter;
use MyENA\RGW\Parameter\SingleParameter;
use MyENA\RGW\Validators;

/**
 * Class Create
 * @package MyENA\RGW\Chain\User\Key
 */
class Create extends AbstractLink implements MethodLink, ParameterLink, ExecutableLink {
    const METHOD = 'PUT';

    const PARAM_UID          = 'uid';
    const PARAM_SUBUSER      = 'subuser';
    const PARAM_ACCESS_KEY   = 'access-key';
    const PARAM_SECRET_KEY   = 'secret-key';
    const PARAM_KEY_TYPE     = 'key-type';
    const PARAM_GENERATE_KEY = 'generate-key';

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
                (new SingleParameter(self::PARAM_UID, Parameter::IN_QUERY))
                    ->required()
                    ->addValidator(Validators::String()),
                (new SingleParameter(self::PARAM_SUBUSER, Parameter::IN_QUERY))
                    ->addValidator(Validators::String()),
                (new SingleParameter(self::PARAM_ACCESS_KEY, Parameter::IN_QUERY))
                    ->addValidator(Validators::String()),
                (new SingleParameter(self::PARAM_SECRET_KEY, Parameter::IN_QUERY))
                    ->addValidator(Validators::String()),
                (new SingleParameter(self::PARAM_KEY_TYPE, Parameter::IN_QUERY))
                    ->addValidator(Validators::OneOf('s3', 'swift')),
                (new SingleParameter(self::PARAM_GENERATE_KEY, Parameter::IN_QUERY))
                    ->addValidator(Validators::Boolean())
                    ->setDefaultValue(true),
            ];
        }
        return $this->parameters;
    }

    /**
     * @return array(
     * @type \MyENA\RGW\Models\UserKeyCollection|null
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
        return UserKeyCollection::fromPSR7Response($resp);
    }
}