<?php declare(strict_types=1);

namespace MyENA\RGW\Chain\Usage;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Links\ExecutableLink;
use MyENA\RGW\Links\MethodLink;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Models\UsageInfoResponse;
use MyENA\RGW\Parameter;
use MyENA\RGW\Parameter\SingleParameter;
use MyENA\RGW\Validators;

/**
 * Class Info
 * @package MyENA\RGW\Chain\Usage
 */
class Info extends AbstractLink implements MethodLink, ParameterLink, ExecutableLink
{
    public const METHOD = 'GET';

    public const PARAM_UID          = 'uid';
    public const PARAM_START        = 'start';
    public const PARAM_END          = 'end';
    public const PARAM_SHOW_ENTRIES = 'show-entries';
    public const PARAM_SHOW_SUMMARY = 'show-summary';

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
                    ->addValidator(Validators::String()),
                (new SingleParameter(self::PARAM_START, Parameter::IN_QUERY))
                    ->addValidator(Validators::DateTime()),
                (new SingleParameter(self::PARAM_END, Parameter::IN_QUERY))
                    ->addValidator(Validators::DateTime()),
                (new SingleParameter(self::PARAM_SHOW_ENTRIES, Parameter::IN_QUERY))
                    ->addValidator(Validators::Bool()),
                (new SingleParameter(self::PARAM_SHOW_SUMMARY, Parameter::IN_QUERY))
                    ->addValidator(Validators::Bool()),
            ];
        }
        return $this->parameters;
    }

    public function execute(): array
    {
        /** @var \Psr\Http\Message\ResponseInterface $resp */
        /** @var \MyENA\RGW\Error $err */
        [$resp, $err] = $this->client->do($this->buildRequest());
        if (null !== $err) {
            return [null, $err];
        }
        return UsageInfoResponse::fromPSR7Response($resp);
    }
}