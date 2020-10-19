<?php declare(strict_types=1);

namespace MyENA\RGW\Chain\User\Capabilities;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Links\ExecutableLink;
use MyENA\RGW\Links\MethodLink;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Models\UserCapabilityCollection;
use MyENA\RGW\Parameter;
use MyENA\RGW\Parameter\ArrayParameter;
use MyENA\RGW\Validators;

/**
 * Class Add
 * @package MyENA\RGW\Chain\User\Capabilities
 */
class Add extends AbstractLink implements MethodLink, ParameterLink, ExecutableLink
{
    public const METHOD = 'PUT';

    public const PARAM_USER_CAPABILITIES = 'user-caps';

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
                (new ArrayParameter(self::PARAM_USER_CAPABILITIES, Parameter::IN_QUERY))
                    ->requireValue()
                    ->addValidator(Validators::UserCapability()),
            ];
        }
        return $this->parameters;
    }

    /**
     * @return array(
     * @type \MyENA\RGW\Models\UserCapabilityCollection|null
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
        return UserCapabilityCollection::fromPSR7Response($resp);
    }
}