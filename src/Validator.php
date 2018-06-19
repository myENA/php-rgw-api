<?php declare(strict_types=1);

namespace MyENA\RGW;


/**
 * Interface Validator
 * @package MyENA\RGW\Argument
 */
interface Validator
{
    /**
     * Validator name
     *
     * @return string
     */
    public function name(): string;

    /**
     * Performs validity check on provided argument
     *
     * @param mixed $value
     * @return bool
     */
    public function test($value): bool;

    /**
     * Must return a short statement about what this validator expects the value to conform to
     *
     * @return string
     */
    public function expectedStatement(): string;
}