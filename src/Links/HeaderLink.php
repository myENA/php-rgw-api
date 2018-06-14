<?php namespace MyENA\RGW\Links;

/**
 * Interface HeaderLink
 * @package MyENA\RGW\Link
 */
interface HeaderLink {
    /**
     * Must return an array of ["header" => "value"] or ["header" => ["value1", "value2"]]
     *
     * @return array
     */
    public function getRequestHeaders(): array;
}