<?php declare(strict_types=1);

namespace MyENA\RGW;

/**
 * Interface Parameter
 * @package MyENA\RGW
 */
interface Parameter
{
    const IN_ROUTE = 'route';
    const IN_QUERY = 'query';

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return bool
     */
    public function isRequired(): bool;

    /**
     * Marks this parameter as requiring a value be defined.
     *
     * @return static
     */
    public function requireValue(): Parameter;

    /**
     * Marks this parameter as requiring its value to not be empty, if defined with one.
     *
     * @return \MyENA\RGW\Parameter
     */
    public function requireNotEmpty(): Parameter;

    /**
     * Must set the default value for this parameter
     *
     * @param mixed $value
     * @return static
     */
    public function setDefaultValue($value): Parameter;

    /**
     * Must either return the value set by @see Parameter::setDefaultValue(), or NULL if no default value set.
     *
     * @return mixed
     */
    public function getDefaultValue();

    /**
     * Location determination [route, query]
     *
     * @return string
     */
    public function getLocation(): string;

    /**
     * Must return URL-representable version of this parameter
     *
     * @return null|string
     */
    public function getEncodedValue(): ?string;

    /**
     * Must return raw value of this parameter
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Must add this validator to the internal list of validators to be run on this Variable's value.  Each validator
     * may only be added once.
     *
     * @param \MyENA\RGW\Validator $validator
     * @return static
     */
    public function addValidator(Validator $validator): Parameter;

    /**
     * Must attempt to retrieve a given validator by name, returning null if the specified validator is not set.
     *
     * @param string $name
     * @return \MyENA\RGW\Validator|null
     */
    public function getValidator(string $name): ?Validator;

    /**
     * Must return all validators set on this parameter, or an empty array of no validators are set.
     *
     * @return \MyENA\RGW\Validator[]
     */
    public function getValidators(): array;

    /**
     * Must test the value present in this Variable against all specified Validators, returning false if any
     * validator failed.
     *
     * Must also reset LastFailedValidator and FailedValidations return values
     *
     * @return bool
     */
    public function isValid(): bool;

    /**
     * Must return the failing validator or null if validation not run / no failures seen.
     *
     * @return \MyENA\RGW\Validator|null
     */
    public function getFailedValidator(): ?Validator;
}