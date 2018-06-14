<?php namespace MyENA\RGW\Chain\User;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Links\ExecutableLink;
use MyENA\RGW\Links\MethodLink;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Models\UserInfo;
use MyENA\RGW\Parameter;
use MyENA\RGW\Parameter\ArrayParameter;
use MyENA\RGW\Parameter\SingleParameter;
use MyENA\RGW\Validators;

/**
 * Class Modify
 * @package MyENA\RGW\Chain\User
 */
class Modify extends AbstractLink implements MethodLink, ParameterLink, ExecutableLink {
    const METHOD = 'POST';

    const PARAM_UID               = 'uid';
    const PARAM_DISPLAY_NAME      = 'display-name';
    const PARAM_EMAIL             = 'email';
    const PARAM_KEY_TYPE          = 'key-type';
    const PARAM_ACCESS_KEY        = 'access-key';
    const PARAM_SECRET_KEY        = 'secret-key';
    const PARAM_USER_CAPABILITIES = 'user-caps';
    const PARAM_GENERATE_KEY      = 'generate-key';
    const PARAM_MAX_BUCKETS       = 'max-buckets';
    const PARAM_SUSPENDED         = 'suspended';

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
                (new SingleParameter(self::PARAM_DISPLAY_NAME, Parameter::IN_QUERY))
                    ->addValidator(Validators::String()),
                (new SingleParameter(self::PARAM_EMAIL, Parameter::IN_QUERY))
                    ->addValidator(Validators::Email()),
                (new SingleParameter(self::PARAM_KEY_TYPE, Parameter::IN_QUERY))
                    ->addValidator(Validators::OneOf('swift', 's3')),
                (new SingleParameter(self::PARAM_ACCESS_KEY, Parameter::IN_QUERY))
                    ->addValidator(Validators::String()),
                (new SingleParameter(self::PARAM_SECRET_KEY, Parameter::IN_QUERY))
                    ->addValidator(Validators::String()),
                (new ArrayParameter(self::PARAM_USER_CAPABILITIES, Parameter::IN_QUERY))
                    ->addValidator(Validators::UserCapability()),
                (new SingleParameter(self::PARAM_GENERATE_KEY, Parameter::IN_QUERY))
                    ->addValidator(Validators::Boolean())
                    ->setDefaultValue(false),
                (new SingleParameter(self::PARAM_MAX_BUCKETS, Parameter::IN_QUERY))
                    ->addValidator(Validators::Integer()),
                (new SingleParameter(self::PARAM_SUSPENDED, Parameter::IN_QUERY))
                    ->addValidator(Validators::Boolean()),
            ];
        }
        return $this->parameters;
    }

    /**
     * @return array(
     * @type \MyENA\RGW\Models\UserInfo|null
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
        return UserInfo::fromPSR7Response($resp);
    }
}