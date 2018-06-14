<?php namespace MyENA\RGW\Parameter;

use MyENA\RGW\Parameter;
use function MyENA\RGW\encodeValue;
use function MyENA\RGW\stringifyValue;

/**
 * Class FixedParameter
 * @package MyENA\RGW\Parameter
 */
class FixedSingleParameter extends SingleParameter {
    /**
     * FixedSingleParameter constructor.
     * @param string $name
     * @param string $location
     * @param        $value
     */
    public function __construct(string $name, string $location, $value) {
        parent::__construct($name, $location);
        $this->setDefaultValue($value);
        $this->required();
    }

    /**
     * @return null|string
     */
    public function getEncodedValue(): ?string {
        return encodeValue($this->getDefaultValue());
    }

    /**
     * @return mixed|null
     */
    public function getValue() {
        return $this->getDefaultValue();
    }

    /**
     * @param $value
     * @return \MyENA\RGW\Parameter
     */
    public function setValue($value): Parameter {
        if (null !== $value) {
            throw new \BadMethodCallException(sprintf(
                'FixedParameter %s cannot have its value changed to %s',
                $this->getName(),
                stringifyValue($value)
            ));
        }
        return $this;
    }
}
