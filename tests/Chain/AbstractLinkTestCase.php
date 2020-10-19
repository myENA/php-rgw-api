<?php declare(strict_types=1);

namespace MyENA\RGW\Tests\Chain;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\RequestOptions;
use MyENA\DefaultANSILogger;
use MyENA\RGW\Client;
use MyENA\RGW\Config;
use MyENA\RGW\Signature\V2Signature;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractLinkTestCase
 * @package MyENA\RGW\Tests\Chain
 */
abstract class AbstractLinkTestCase extends TestCase
{
    /** @var \MyENA\RGW\Client */
    protected static $client;

    public static function setUpBeforeClass(): void
    {
        self::$client = new Client(
            Config::defaultConfig(new HttpClient([RequestOptions::VERIFY => false]), new DefaultANSILogger()),
            new V2Signature()
        );
    }
}