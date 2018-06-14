<?php namespace MyENA\RGW\Chain\Bucket;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Links\ExecutableLink;
use MyENA\RGW\Links\MethodLink;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Parameter;
use MyENA\RGW\Parameter\SingleParameter;
use MyENA\RGW\Validators;
use function MyENA\RGW\decodeBody;

/**
 * Class ListBuckets
 * @package MyENA\RGW\Chain\Bucket
 */
class ListBuckets extends AbstractLink implements MethodLink, ParameterLink, ExecutableLink {
    const METHOD = 'GET';

    const PARAM_UID = 'uid';

    /** @var \MyENA\RGW\Parameter\[] */
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
                    ->addValidator(Validators::String()),
            ];
        }
        return $this->parameters;
    }

    /**
     * @return array(
     * @type string[]|null List of bucket names
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
        return decodeBody($resp);
    }
}