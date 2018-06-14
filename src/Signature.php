<?php namespace MyENA\RGW;

use Psr\Http\Message\RequestInterface;

/**
 * Interface Signature
 * @package MyENA\RGW
 */
interface Signature {
    /**
     * @param \MyENA\RGW\Config                  $config
     * @param \Psr\Http\Message\RequestInterface $request
     * @return \Psr\Http\Message\RequestInterface
     */
    public function sign(Config $config, RequestInterface $request): RequestInterface;
}