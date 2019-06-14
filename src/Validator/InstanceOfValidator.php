<?php declare(strict_types=1);

namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * Class InstanceOfValidator
 * @package MyENA\RGW\Validator
 */
class InstanceOfValidator implements Validator
{
    const NAME = 'instance-of';

    /** @var string */
    private $class;

    /**
     * InstanceOfValidator constructor.
     * @param string $class
     */
    public function __construct(string $class)
    {
        $this->class = $class;
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
        return is_object($value) && $value instanceof $this->class;
    }

    /**
     * @return string
     */
    public function expectedStatement(): string
    {
        return 'object that is an instance of ' . $this->class;
    }
}