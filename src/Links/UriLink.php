<?php declare(strict_types=1);

namespace MyENA\RGW\Links;

/**
 * Interface UriLink
 * @package MyENA\RGW\Link
 */
interface UriLink
{
    /**
     * @return string
     */
    public function getUriPart(): string;
}