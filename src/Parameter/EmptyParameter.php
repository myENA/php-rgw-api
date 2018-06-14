<?php namespace MyENA\RGW\Parameter;

use MyENA\RGW\AbstractParameter;
use MyENA\RGW\Parameter;
use function MyENA\RGW\stringifyValue;
use MyENA\RGW\Validator;

/**
 * Class EmptyParameter
 * @package MyENA\RGW\Parameter
 */
class EmptyParameter extends AbstractParameter {
    /**
     * EmptyParameter constructor.
     * @param string $name
     */
    public function __construct(string $name) {
        parent::__construct($name, Parameter::IN_QUERY);
    }

    /**
     * @param mixed $defaultValue
     * @return \MyENA\RGW\Parameter
     */
    public function setDefaultValue($defaultValue): Parameter {
        throw new \BadMethodCallException(sprintf(
            'EmptyParameter %s cannot have a default value of %s',
            $this->getName(),
            stringifyValue($defaultValue)
        ));
    }

    /**
     * @return mixed|null|void
     */
    public function getDefaultValue() {
        throw new \BadMethodCallException(sprintf(
            'EmptyParameter %s cannot have a default value',
            $this->getName()
        ));
    }

    /**
     * @param \MyENA\RGW\Validator $validator
     * @return \MyENA\RGW\Parameter
     */
    public function addValidator(Validator $validator): Parameter {
        throw new \BadMethodCallException(sprintf(
            'Cannot add validator %s to EmptyParameter %s as there is nothing to validate',
            $validator->name(),
            $this->getName()
        ));
    }

    /**
     * @return null|string
     */
    public function getEncodedValue(): ?string {
        throw new \BadMethodCallException(sprintf(
            'EmptyParameter %s has no value',
            $this->getName()
        ));
    }

    /**
     * @return mixed|void
     */
    public function getValue() {
        throw new \BadMethodCallException(sprintf(
            'EmptyParameter %s has no value',
            $this->getName()
        ));
    }

    /**
     * @return bool
     */
    public function isValid(): bool {
        return true;
    }
}
