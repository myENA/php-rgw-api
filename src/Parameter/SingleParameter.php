<?php declare(strict_types=1);

namespace MyENA\RGW\Parameter;

use MyENA\RGW\AbstractParameter;
use MyENA\RGW\Parameter;
use function MyENA\RGW\encodeValue;

/**
 * Class SingleParameter
 * @package MyENA\RGW\Request
 */
class SingleParameter extends AbstractParameter
{
    /** @var mixed */
    protected $value;

    /**
     * Perform validation of this parameter against stored validators.
     *
     * TODO: Allow for fallthrough on failed validator to perform others
     *
     * @return bool
     */
    public function isValid(): bool
    {
        unset($this->failedValidator);
        $value = $this->getValue();
        if (!$this->isRequired() && null === $value) {
            return true;
        }
        foreach ($this->getValidators() as $validator) {
            if (!$validator->test($value)) {
                $this->failedValidator = $validator;
                return false;
            }
        }
        return true;
    }

    /**
     * Will attempt to return a usable value for this parameter preferring a specified one, falling back to
     * default (if set), and finally null
     *
     * @return mixed|null
     */
    public function getValue()
    {
        return $this->value ?? $this->getDefaultValue();
    }

    /**
     * @param $value
     * @return static
     */
    public function setValue($value): Parameter
    {
        if (isset($this->value) && $this->value !== $value) {
            unset($this->failedValidator);
        }
        if (is_object($value)) {
            $this->value = clone $value;
        } else {
            $this->value = $value;
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getEncodedValue(): ?string
    {
        if (null !== ($v = $this->getValue())) {
            return encodeValue($v);
        }
        return null;
    }
}