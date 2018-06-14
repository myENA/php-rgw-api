<?php namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * Class OneOfValidator
 * @package MyENA\RGW\Validator
 */
class OneOfValidator implements Validator {
    const NAME = 'one-of';

    /** @var array */
    private $allowed = [];

    /**
     * RequiredValidator constructor.
     * @param array $allowed
     */
    public function __construct(array $allowed) {
        $this->allowed = $allowed;
    }

    /**
     * @return string
     */
    public function name(): string {
        return self::NAME;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function test($value): bool {
        return in_array($value, $this->allowed, true);
    }
}
