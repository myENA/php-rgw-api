<?php declare(strict_types=1);

namespace MyENA\RGW\Chain\User;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Chain\User\SubUser\Create;
use MyENA\RGW\Chain\User\SubUser\Delete;
use MyENA\RGW\Chain\User\SubUser\Modify;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Parameter;
use MyENA\RGW\Parameter\EmptyParameter;
use MyENA\RGW\Parameter\SingleParameter;
use MyENA\RGW\Validators;

/**
 * Class SubUser
 * @package MyENA\RGW\Chain\User
 */
class SubUser extends AbstractLink implements ParameterLink
{
    public const PARAM_UID = 'uid';

    /** @var \MyENA\RGW\Parameter[] */
    private $parameters;

    /**
     * @return \MyENA\RGW\Parameter[]
     */
    public function getParameters(): array
    {
        if (!isset($this->parameters)) {
            $this->parameters = [
                new EmptyParameter('subuser'),
                (new SingleParameter(self::PARAM_UID, Parameter::IN_QUERY))
                    ->requireValue()
                    ->addValidator(Validators::String()),
            ];
        }
        return $this->parameters;
    }

    /**
     * @param string $subUser
     * @param array $optional
     * @return \MyENA\RGW\Chain\User\SubUser\Create
     */
    public function Create(string $subUser, array $optional = []): Create
    {
        return Create::new($this, [Create::PARAM_SUBUSER => $subUser] + $optional);
    }

    /**
     * @param string $subUser
     * @param array $optional
     * @return \MyENA\RGW\Chain\User\SubUser\Modify
     */
    public function Modify(string $subUser, array $optional = []): Modify
    {
        return Modify::new($this, [Modify::PARAM_SUBUSER => $subUser] + $optional);
    }

    /**
     * @param string $subUser
     * @param bool $purgeKeys
     * @return \MyENA\RGW\AbstractLink|\MyENA\RGW\Chain\User\SubUser\Delete
     */
    public function Delete(string $subUser, bool $purgeKeys = true)
    {
        return Delete::new($this, [Delete::PARAM_SUBUSER => $subUser, Delete::PARAM_PURGE_KEYS => $purgeKeys]);
    }
}