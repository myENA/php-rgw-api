<?php namespace MyENA\RGW\Links;

/**
 * Interface BodyLink
 * @package MyENA\RGW\Link
 */
interface BodyLink extends HeaderLink {

    // Extending header, as you should probably set the Content-Type in there.

    /**
     * Must return the body to be used in this request
     *
     * @return mixed
     */
    public function getBody();

    /**
     * Must return class name of request body
     *
     * @return string
     */
    public function getBodyClass(): string;

    /**
     * @param mixed $body
     */
    public function setBody($body): void;
}