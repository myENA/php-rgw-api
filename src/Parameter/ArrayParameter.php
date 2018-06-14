<?php namespace MyENA\RGW\Parameter;

use MyENA\RGW\AbstractParameter;
use function MyENA\RGW\encodeValue;

/**
 * Class ArrayParameter
 * @package MyENA\RGW\Parameter
 */
class ArrayParameter extends AbstractParameter implements \Iterator, \Countable {
    /** @var array */
    private $values = [];

    /**
     * @param mixed $value
     * @return static
     */
    public function addValue($value): ArrayParameter {
        if (null === $value) { // TODO: Not sure I like this...
            return $this;
        }
        $this->failedValidator = null;
        $this->values[] = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function isValid(): bool {
        $this->failedValidator = null;
        if (!$this->isRequired() && 0 === count($this)) {
            return true;
        }
        foreach ($this->values as $value) {
            foreach ($this->validators as $validator) {
                if (!$validator->test($value)) {
                    $this->failedValidator = $validator;
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * @return null|string
     */
    public function getEncodedValue(): ?string {
        if (0 === count($this)) {
            if (null !== ($def = $this->getDefaultValue())) {
                return encodeValue($def);
            }
            return null;
        }
        $vs = [];
        foreach ($this as $value) {
            $vs[] = encodeValue($value);
        }
        return implode(';', $vs);
    }

    /**
     * @return array
     */
    public function getValue() {
        return $this->values;
    }

    /**
     * @return mixed
     */
    public function current() {
        return current($this->values);
    }

    public function next() {
        next($this->values);
    }

    /**
     * @return int
     */
    public function key() {
        return key($this->values);
    }

    /**
     * @return bool
     */
    public function valid() {
        return null !== key($this->values);
    }

    public function rewind() {
        reset($this->values);
    }

    /**
     * @return int
     */
    public function count() {
        return count($this->values);
    }
}