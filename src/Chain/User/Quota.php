<?php declare(strict_types=1);

namespace MyENA\RGW\Chain\User;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Chain\User\Quota\All;
use MyENA\RGW\Chain\User\Quota\Get;
use MyENA\RGW\Chain\User\Quota\Set;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Parameter;
use MyENA\RGW\Parameter\EmptyParameter;
use MyENA\RGW\Parameter\SingleParameter;
use MyENA\RGW\Validators;

/**
 * Class Quota
 * @package MyENA\RGW\Chain\User
 */
class Quota extends AbstractLink implements ParameterLink
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
                new EmptyParameter('quota'),
                (new SingleParameter(self::PARAM_UID, Parameter::IN_QUERY))
                    ->requireValue()
                    ->addValidator(Validators::String()),
            ];
        }
        return $this->parameters;
    }

    /**
     * @return \MyENA\RGW\Chain\User\Quota\All
     */
    public function All(): All
    {
        return All::new($this);
    }

    /**
     * @param string $quotaType
     * @return \MyENA\RGW\Chain\User\Quota\Get
     */
    public function Get(string $quotaType): Get
    {
        return Get::new($this, [Get::PARAM_QUOTA_TYPE => $quotaType]);
    }

    /**
     * @param string $quotaType
     * @param int $maximumObjects
     * @param int $maximumSizeKb
     * @param bool $enabled
     * @return \MyENA\RGW\Chain\User\Quota\Set
     */
    public function Set(
        string $quotaType,
        ?int $maximumObjects = null,
        ?int $maximumSizeKb = null,
        bool $enabled = false
    ): Set {
        return Set::new(
            $this,
            [
                Set::PARAM_QUOTA_TYPE  => $quotaType,
                Set::PARAM_MAX_OBJECTS => $maximumObjects,
                Set::PARAM_MAX_SIZE_KB => $maximumSizeKb,
                Set::PARAM_ENABLED     => $enabled,
            ]
        );
    }
}