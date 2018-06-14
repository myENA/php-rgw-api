<?php namespace MyENA\RGW\Links;

/**
 * Interface ParameterLink
 * @package MyENA\RGW\Links
 */
interface ParameterLink {

    /**
     * Must return array of Parameters that will be used on execution.
     *
     * @return \MyENA\RGW\Parameter\SingleParameter[]
     */
    public function getParameters(): array;
}