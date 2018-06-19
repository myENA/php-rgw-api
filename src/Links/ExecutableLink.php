<?php declare(strict_types=1);

namespace MyENA\RGW\Links;

/**
 * Interface Executable
 * @package MyENA\RGW
 */
interface ExecutableLink
{
    /**
     * @return array(
     * @type mixed|null              Value will vary depending on call being made
     * @type \MyENA\RGW\Error|null   Value MUST be Error or null
     * )
     */
    public function execute(): array;
}