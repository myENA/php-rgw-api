<?php declare(strict_types=1);

namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * Class OneOfValidator
 * @package MyENA\RGW\Validator
 */
class OneOfValidator implements Validator
{
    public const NAME = 'one-of';

    /** @var array */
    private $allowed = [];

    /**
     * RequiredValidator constructor.
     * @param array $allowed
     */
    public function __construct(array $allowed)
    {
        $this->allowed = $allowed;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return self::NAME;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function test($value): bool
    {
        return in_array($value, $this->allowed, true);
    }

    /**
     * @return string
     */
    public function expectedStatement(): string
    {
        return 'value equating to one of: [' .
            implode(', ', array_map('\\MyENA\\RGW\\stringifyValueTyped', $this->allowed)) .
            ']';
    }
}
