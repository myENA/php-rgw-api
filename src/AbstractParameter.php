<?php namespace MyENA\RGW;

/**
 * Class AbstractParameter
 * @package MyENA\RGW
 */
abstract class AbstractParameter implements Parameter {
    /** @var string */
    protected $name = '';
    /** @var string */
    protected $location;

    /** @var mixed */
    protected $default;

    /** @var \MyENA\RGW\Validator[] */
    protected $validators = [];

    /** @var \MyENA\RGW\Validator */
    protected $failedValidator;

    /**
     * AbstractParameter constructor.
     * @param string $name
     * @param string $location
     */
    public function __construct(string $name, string $location) {
        if ('' === ($name = trim($name))) {
            throw new \InvalidArgumentException('name cannot be empty');
        }
        $this->name = $name;
        if ($location !== self::IN_ROUTE && $location !== self::IN_QUERY) {
            throw new \InvalidArgumentException(sprintf(
                'location must be one of: ["%s"]',
                implode('", "', [self::IN_ROUTE, self::IN_QUERY])
            ));
        }
        $this->location = $location;
        if (self::IN_ROUTE === $location) {
            $this->required();
        }
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLocation(): string {
        return $this->location;
    }

    /**
     * Is this parameter required by the part?
     *
     * @return bool
     */
    public function isRequired(): bool {
        return isset($this->validators[Validator\RequiredValidator::NAME]);
    }

    /**
     * Mark this parameter as "required", meaning it must either have a specific or default value
     *
     * @return \MyENA\RGW\Parameter\SingleParameter
     */
    public function required(): Parameter {
        $this->validators = [
                Validator\RequiredValidator::NAME => new Validator\RequiredValidator(),
            ] + $this->validators;
        return $this;
    }

    /**
     * Sets a default value for this argument
     *
     * @param mixed $defaultValue
     * @return static
     */
    public function setDefaultValue($defaultValue): Parameter {
        if (isset($this->default) && $this->default !== $defaultValue) {
            unset($this->failedValidator);
        }
        if (is_object($defaultValue)) {
            $this->default = clone $defaultValue;
        } else {
            $this->default = $defaultValue;
        }
        return $this;
    }

    /**
     * @return mixed|null
     */
    public function getDefaultValue() {
        return $this->default ?? null;
    }

    /**
     * @param \MyENA\RGW\Validator $validator
     * @return \MyENA\RGW\Parameter\SingleParameter
     */
    public function addValidator(Validator $validator): Parameter {
        $this->validators[$validator->name()] = $validator;
        return $this;
    }

    /**
     * Returns all validators registered with this argument
     *
     * @return \MyENA\RGW\Validator[]
     */
    public function getValidators(): array {
        return $this->validators;
    }

    /**
     * Attempts to return a specific validator
     *
     * @param string $name
     * @return \MyENA\RGW\Validator|null
     */
    public function getValidator(string $name): ?Validator {
        return $this->validators[$name] ?? null;
    }

    /**
     * Returns the last validator to fail, if validation attempt was made
     *
     * @return \MyENA\RGW\Validator|null
     */
    public function getFailedValidator(): ?Validator {
        return $this->failedValidator ?? null;
    }
}