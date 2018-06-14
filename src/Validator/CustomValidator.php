<?php namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * Class CustomValidator
 * @package MyENA\RGW\Validator
 */
class CustomValidator implements Validator {
    const NAME = 'custom';

    /** @var string */
    private $name;
    /** @var \Closure */
    private $callable;

    /**
     * CustomValidator constructor.
     * @param string $name
     * @param        $callable
     */
    public function __construct(string $name, $callable) {
        $this->name = $name;
        $this->callable = $callable;
    }

    /**
     * @return string
     */
    public function name(): string {
        return $this->name ?? self::NAME;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function test($value): bool {
        return (bool)call_user_func($this->callable, $value);
    }
}