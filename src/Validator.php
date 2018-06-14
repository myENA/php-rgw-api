<?php namespace MyENA\RGW;


/**
 * Interface Validator
 * @package MyENA\RGW\Argument
 */
interface Validator {
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
}