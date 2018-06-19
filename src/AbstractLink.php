<?php declare(strict_types=1);

namespace MyENA\RGW;

use MyENA\RGW\Links\BodyLink;
use MyENA\RGW\Links\ExecutableLink;
use MyENA\RGW\Links\HeaderLink;
use MyENA\RGW\Links\MethodLink;
use MyENA\RGW\Links\ParameterLink;
use MyENA\RGW\Links\UnauthenticatedLink;
use MyENA\RGW\Links\UriLink;
use MyENA\RGW\Parameter\ArrayParameter;
use MyENA\RGW\Parameter\EmptyParameter;
use MyENA\RGW\Parameter\SingleParameter;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;

/**
 * Class AbstractLink
 * @package MyENA\RGW
 */
abstract class AbstractLink implements LoggerAwareInterface
{

    use LoggerAwareTrait;

    /** @var \MyENA\RGW\Client */
    protected $client;
    /** @var \MyENA\RGW\AbstractLink[] */
    protected $parents;

    /**
     * AbstractLink constructor.
     * @param \MyENA\RGW\Client $client
     * @param \Psr\Log\LoggerInterface $logger
     * @param \MyENA\RGW\AbstractLink[] $parents
     */
    protected function __construct(Client $client, LoggerInterface $logger, AbstractLink ...$parents)
    {
        $this->client = $client;
        $this->logger = $logger;
        $this->parents = $parents;
    }

    /**
     * TODO: Simplify a bit?
     *
     * @param \MyENA\RGW\Client $client
     * @param \Psr\Log\LoggerInterface $logger
     * @param array $paramValueMap
     * @param \MyENA\RGW\AbstractLink|null $parent
     * @return static
     */
    public static function new(
        ?AbstractLink $parent = null,
        array $paramValueMap = [],
        ?Client $client = null,
        ?LoggerInterface $logger = null
    ): AbstractLink {
        if (null !== $parent) {
            $client = $parent->client;
            $logger = $parent->logger;
            $parents = $parent->buildParentList();
        } elseif (null === $client || null === $logger) {
            throw new \LogicException(sprintf(
                'Cannot construct %s, either a $parent must be passed or both $client and $logger must be passed',
                static::class
            ));
        }
        $link = new static($client, $logger, ...($parents ?? [])); // TODO: this is probably SUPER inefficient..
        if ($link instanceof ParameterLink) {
            $link->parseParameters($link, $paramValueMap);
        } elseif (0 !== ($cnt = count($paramValueMap))) {
            throw new \DomainException(sprintf(
                'Link %s does not have any parameters, yet %d were passed',
                get_class($link),
                $cnt
            ));
        }
        return $link;
    }

    /**
     * @return \MyENA\RGW\AbstractLink[]
     */
    protected function buildParentList(): array
    {
        $p = [];
        foreach ($this->parents as $parent) {
            $p[] = clone $parent;
        }
        $p[] = clone $this;
        return $p;
    }

    /**
     * @param \MyENA\RGW\Links\ParameterLink $part
     * @param array $defined
     */
    protected function parseParameters(ParameterLink $part, array $defined = []): void
    {
        foreach ($part->getParameters() as $parameter) {
            $name = $parameter->getName();
            $value = $defined[$name] ?? null;
            if ($parameter instanceof SingleParameter) {
                $parameter->setValue($value);
            } elseif ($parameter instanceof ArrayParameter) {
                if (is_array($value)) {
                    foreach ($value as $v) {
                        $parameter->addValue($v);
                    }
                } else {
                    $parameter->addValue($value);
                }
            } elseif ($parameter instanceof EmptyParameter) {
                if (null !== $value) {
                    throw new \InvalidArgumentException(sprintf(
                        'Cannot specify value for EmptyParameter %s',
                        $name
                    ));
                }
            } else {
                throw new \DomainException(sprintf(
                    '%s is not a valid parameter type',
                    is_object($parameter) ? get_class($parameter) : gettype($parameter)
                ));
            }
            if (!$parameter->isValid()) {
                throw new \InvalidArgumentException(sprintf(
                    'Parameter %s failed %s validator with value: %s.  Expected: %s',
                    $parameter->getName(),
                    $parameter->getFailedValidator()->name(),
                    !is_resource($parameter->getValue()) ? json_encode($parameter->getValue()) : 'resource',
                    $parameter->getFailedValidator()->expectedStatement()
                ));
            }
        }
    }

    /**
     * @return \MyENA\RGW\Request
     */
    public function buildRequest(): Request
    {
        if ($this instanceof ExecutableLink) {
            return new Request(
                $this->findMethod(),
                $this->buildUri(),
                $this->compileRequestHeaders(),
                $this->compileQueryParameters(),
                ($this instanceof BodyLink ? $this->getBody() : null),
                !($this instanceof UnauthenticatedLink)
            );
        } else {
            throw $this->createInvalidChainException('ExecutableLink');
        }
    }

    /**
     * @return string
     */
    protected function findMethod(): string
    {
        if ($this instanceof MethodLink) {
            return $this->getRequestMethod();
        } else {
            foreach ($this->parents as $parent) {
                if ($parent instanceof MethodLink) {
                    return $parent->getRequestMethod();
                }
            }
            throw $this->createInvalidChainException('MethodLink');
        }
    }

    /**
     * @param string $missing
     * @return \DomainException
     */
    protected function createInvalidChainException(string $missing): \DomainException
    {
        $parts = [];
        foreach ($this->parents as $parent) {
            $parts[] = get_class($parent);
        }
        $parts[] = get_class($this);

        return new \DomainException(sprintf(
            'Request Chain has no %s: ["%s"]',
            $missing,
            implode('", "', $parts)
        ));
    }

    /**
     * @return string
     */
    protected function buildUri(): string
    {
        $routeParams = [];
        $uri = '';
        foreach ($this->parents as $parent) {
            if ($parent instanceof UriLink) {
                $uri = "{$uri}{$parent->getUriPart()}";
            }
            if ($parent instanceof ParameterLink) {
                foreach ($parent->getParameters() as $parameter) {
                    if ($parameter->getLocation() === Parameter::IN_ROUTE) {
                        $routeParams[$parameter->getName()] = $parameter->getValue();
                    }
                }
            }
        }
        if ($this instanceof UriLink) {
            $uri = "{$uri}{$this->getUriPart()}";
        }
        if ('' === $uri) {
            throw $this->createInvalidChainException('UriLink');
        }
        if ($this instanceof ParameterLink) {
            foreach ($this->getParameters() as $parameter) {
                if ($parameter->getLocation() === Parameter::IN_ROUTE) {
                    $routeParams[$parameter->getName()] = $parameter->getValue();
                }
            }
        }
        foreach ($routeParams as $name => $value) {
            $uri = str_replace("{{$name}}", $value, $uri);
        }
        return $uri;
    }

    /**
     * @return array
     */
    protected function compileRequestHeaders(): array
    {
        $headers = [];
        if ($this instanceof HeaderLink) {
            $headers = $this->getRequestHeaders();
        }
        foreach ($this->parents as $parent) {
            if ($parent instanceof HeaderLink) {
                foreach ($parent->getRequestHeaders() as $header => $value) {
                    if (!isset($headers[$header])) {
                        $headers[$header] = $value;
                    } elseif (is_array($headers[$header])) {
                        if (is_array($value)) {
                            $headers[$header] = array_merge($headers[$header], $value);
                        } else {
                            $headers[$header][] = $value;
                        }
                    } elseif (is_array($value)) {
                        $headers[$header] = array_merge([$headers[$header]], $value);
                    } else {
                        $headers[$header] = [$headers[$header], $value];
                    }
                }
            }
        }
        return $headers;
    }

    /**
     * @return array
     */
    protected function compileQueryParameters(): array
    {
        $queryParams = [];
        foreach ($this->parents as $parent) {
            if ($parent instanceof ParameterLink) {
                foreach ($parent->getParameters() as $parameter) {
                    if ($parameter->getLocation() === Parameter::IN_QUERY) {
                        if ($parameter instanceof EmptyParameter) {
                            $queryParams[$parameter->getName()] = null;
                        } elseif (null !== ($value = $parameter->getEncodedValue())) {
                            $queryParams[$parameter->getName()] = $value;
                        }
                    }
                }
            }
        }
        if ($this instanceof ParameterLink) {
            foreach ($this->getParameters() as $parameter) {
                if ($parameter->getLocation() === Parameter::IN_QUERY) {
                    if ($parameter instanceof EmptyParameter) {
                        $queryParams[$parameter->getName()] = null;
                    } elseif (null !== ($value = $parameter->getEncodedValue())) {
                        $queryParams[$parameter->getName()] = $value;
                    }
                }
            }
        }
        return $queryParams;
    }

    /**
     * @param string $expected
     * @param mixed $actual
     * @return \DomainException
     */
    protected function createInvalidRequestBodyException(string $expected, $actual): \DomainException
    {
        return new \DomainException(sprintf(
            'Link %s requires body of type %s, %s provided.',
            get_class($this),
            $expected,
            is_object($actual) ? get_class($actual) : gettype($actual)
        ));
    }
}