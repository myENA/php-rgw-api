<?php declare(strict_types=1);

namespace MyENA\RGW\Chain\User;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Links\ExecutableLink;
use MyENA\RGW\Links\MethodLink;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Parameter;
use MyENA\RGW\Parameter\SingleParameter;
use MyENA\RGW\Validators;

/**
 * Class Delete
 * @package MyENA\RGW\Chain\User
 */
class Delete extends AbstractLink implements MethodLink, ParameterLink, ExecutableLink
{
    const METHOD = 'DELETE';

    const PARAM_UID        = 'uid';
    const PARAM_PURGE_DATA = 'purge-data';

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
                (new SingleParameter(self::PARAM_PURGE_DATA, Parameter::IN_QUERY))
                    ->addValidator(Validators::Boolean()),
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