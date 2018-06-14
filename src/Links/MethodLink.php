<?php namespace MyENA\RGW\Links;

/**
 * Interface MethodLink
 * @package MyENA\RGW\Link
 */
interface MethodLink {
    /**
     * @return string
     */
    public function getRequestMethod(): string;
}