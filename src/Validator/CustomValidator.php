<?php declare(strict_types=1);

namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * Class CustomValidator
 * @package MyENA\RGW\Validator
 */
class CustomValidator implements Validator
{
    const NAME = 'custom';

    /** @var string */
    private $name;
    /** @var \Closure */
    private $callable;
    /** @var string */
    private $expects;

    /**
     * CustomValidator constructor.
     * @param string $name
     * @param        $callable
     * @param string $expects
     */
    public function __construct(string $name, $callable, string $expects = 'true from custom validator callable')
    {
        $this->name = $name;
        $this->callable = $callable;
        $this->expects = $expects;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name ?? self::NAME;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function test($value): bool
    {
        return (bool)call_user_func($this->callable, $value);
    }

    /**
     * @return string
     */
    public function expectedStatement(): string
    {
        return $this->expects;
    }
}