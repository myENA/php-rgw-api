<?php namespace MyENA\RGW\Chain\User;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Chain\User\Capabilities\Add;
use MyENA\RGW\Chain\User\Capabilities\Remove;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Models\UserCapability;
use MyENA\RGW\Parameter;
use MyENA\RGW\Parameter\EmptyParameter;
use MyENA\RGW\Parameter\SingleParameter;
use MyENA\RGW\Validators;

/**
 * Class Capabilities
 * @package MyENA\RGW\Chain\User
 */
class Capabilities extends AbstractLink implements ParameterLink {
    /** @var \MyENA\RGW\Parameter[] */
    private $parameters;

    const PARAM_UID = 'uid';

    /**
     * @return \MyENA\RGW\Parameter[]
     */
    public function getParameters(): array {
        if (!isset($this->parameters)) {
            $this->parameters = [
                new EmptyParameter('caps'),
                (new SingleParameter(self::PARAM_UID, Parameter::IN_QUERY))
                    ->required()
                    ->addValidator(Validators::String()),
            ];
        }
        return $this->parameters;
    }


    /**
     * @param \MyENA\RGW\Models\UserCapability ...$capabilities
     * @return \MyENA\RGW\Chain\User\Capabilities\Add
     */
    public function Add(UserCapability ...$capabilities): Add {
        return Add::new($this, [Add::PARAM_USER_CAPABILITIES => $capabilities]);
    }

    /**
     * @param \MyENA\RGW\Models\UserCapability ...$capabilities
     * @return \MyENA\RGW\Chain\User\Capabilities\Remove
     */
    public function Remove(UserCapability ...$capabilities): Remove {
        return Remove::new($this, [Remove::PARAM_USER_CAPABILITIES => $capabilities]);
    }
}