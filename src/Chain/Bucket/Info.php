<?php declare(strict_types=1);

namespace MyENA\RGW\Chain\Bucket;

use MyENA\RGW\AbstractLink;
use MyENA\RGW\Chain\Bucket\Info\All;
use MyENA\RGW\Chain\Bucket\Info\One;
use MyENA\RGW\Links\MethodLink;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Parameter;
use MyENA\RGW\Parameter\FixedSingleParameter;
use MyENA\RGW\Parameter\SingleParameter;
use MyENA\RGW\Validators;

/**
 * Class Info
 * @package MyENA\RGW\Chain\Bucket
 */
class Info extends AbstractLink implements MethodLink, ParameterLink
{
    const METHOD = 'GET';

    const PARAM_UID = 'uid';

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
                new FixedSingleParameter('stats', Parameter::IN_QUERY, true),
                (new SingleParameter(self::PARAM_UID, Parameter::IN_QUERY))
                    ->requireValue()
                    ->addValidator(Validators::String()),
            ];
        }
        return $this->parameters;
    }

    /**
     * @param string $bucket
     * @return \MyENA\RGW\Chain\Bucket\Info\One
     */
    public function One(string $bucket): One
    {
        return One::new($this, [One::PARAM_BUCKET => $bucket]);
    }

    /**
     * @return \MyENA\RGW\Chain\Bucket\Info\All
     */
    public function All(): All
    {
        return All::new($this);
    }
}