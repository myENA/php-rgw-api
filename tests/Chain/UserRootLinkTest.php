<?php declare(strict_types=1);

namespace MyENA\RGW\Tests\Chain;

use MyENA\RGW\Chain\User\Capabilities;
use MyENA\RGW\Chain\User\Create as UserCreate;
use MyENA\RGW\Chain\User\Delete as UserDelete;
use MyENA\RGW\Chain\User\Key;
use MyENA\RGW\Chain\User\Modify as UserModify;
use MyENA\RGW\Chain\User\Quota;
use MyENA\RGW\Chain\UserRootLink;
use MyENA\RGW\Client;
use PHPUnit\Framework\TestCase;

/**
 * Class UserRootLinkTest
 * @package MyENA\RGW\Tests\User
 */
class UserRootLinkTest extends TestCase
{
    /** @var \MyENA\RGW\Client */
    protected static $client;

    /**
     * Constructs a new client to use for this test class
     */
    public static function setUpBeforeClass()
    {
        self::$client = Client::defaultClient();
    }

    public function testCanGetUserRootLink(): void
    {
        $ul = self::$client->User();
        $this->assertInstanceOf(UserRootLink::class, $ul);
    }

    public function testCanGetCreateLink(): void
    {
        $create = self::$client->User()->Create(RGW_TEST_USER_UID, RGW_TEST_USER_DISPLAY_NAME);
        $this->assertInstanceOf(UserCreate::class, $create);
    }

    public function testCanGetDeleteLink(): void
    {
        $delete = self::$client->User()->Delete(RGW_TEST_USER_UID);
        $this->assertInstanceOf(UserDelete::class, $delete);
    }

    public function testCanGetModifyLink(): void
    {
        $modify = self::$client->User()->Modify(RGW_TEST_USER_UID);
        $this->assertInstanceOf(UserModify::class, $modify);
    }

    public function testCanGetQuotaLink(): void
    {
        $quota = self::$client->User()->Quota(RGW_TEST_USER_UID);
        $this->assertInstanceOf(Quota::class, $quota);
    }

    public function testCanGetCapabilitiesLink(): void
    {
        $capabilities = self::$client->User()->Capabilities(RGW_TEST_USER_UID);
        $this->assertInstanceOf(Capabilities::class, $capabilities);
    }

    public function testCanGetKeyLink(): void
    {
        $key = self::$client->User()->Key();
        $this->assertInstanceOf(Key::class, $key);
    }
}
