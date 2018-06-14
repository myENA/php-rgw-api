<?php namespace MyENA\RGW\Chain\User\Quota;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Links\ExecutableLink;
use MyENA\RGW\Links\MethodLink;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Models\QuotaMeta;
use MyENA\RGW\Parameter;
use MyENA\RGW\Parameter\SingleParameter;
use MyENA\RGW\Validators;

/**
 * Class Get
 * @package MyENA\RGW\Chain\User\Quota
 */
class Get extends AbstractLink implements MethodLink, ParameterLink, ExecutableLink {
    const METHOD = 'GET';

    const PARAM_QUOTA_TYPE = 'quota-type';

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
                (new SingleParameter(self::PARAM_QUOTA_TYPE, Parameter::IN_QUERY))
                    ->required()
                    ->addValidator(Validators::OneOf('user', 'bucket')),
            ];
        }
        return $this->parameters;
    }

    /**
     * @return array(
     * @type \MyENA\RGW\Models\QuotaMeta|null
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
        return QuotaMeta::fromPSR7Response($resp);
    }
}