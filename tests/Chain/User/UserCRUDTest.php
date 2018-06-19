<?php declare(strict_types=1);

namespace MyENA\RGW\Tests\Chain\User;

use MyENA\RGW\Chain\User\Create;
use MyENA\RGW\Chain\User\Modify;
use MyENA\RGW\Models\UserInfo;
use MyENA\RGW\Tests\Chain\AbstractLinkTestCase;

/**
 * Class UserCRUDTest
 * @package MyENA\RGW\Tests\Chain\User
 */
class UserCRUDTest extends AbstractLinkTestCase
{

    public static function tearDownAfterClass()
    {
        // try to delete all users that may have been created here.
        self::$client->User()->Delete(RGW_TEST_USER_UID, true)->execute();
        self::$client->User()->Delete(RGW_TEST_USER_FULL, true)->execute();
    }

    public function testCanCreateUser(): void
    {
        [$user, $err] = self::$client->User()->Create(
            RGW_TEST_USER_UID,
            RGW_TEST_USER_DISPLAY_NAME,
            [
                Create::PARAM_TENANT => RGW_TEST_TENANT,
            ]
        )->execute();
        $this->assertNull($err);
        $this->assertInstanceOf(UserInfo::class, $user);
    }

    /**
     * @depends testCanCreateUser
     */
    public function testCanFetchUserWithoutStats(): void
    {
        // TODO: stats = true returns 404 when no bucket is associated with the user.

        /** @var \MyENA\RGW\Models\UserInfo $user */
        /** @var \MyENA\RGW\Error $err */
        [$user, $err] = self::$client->User()->Info(RGW_TEST_USER_FULL)->execute();
        $this->assertNull($err);
        $this->assertInstanceOf(UserInfo::class, $user);
        $this->assertNull($user->getStats());
    }

    /**
     * @depends testCanCreateUser
     */
    public function testCanModifyUser(): void
    {
        /** @var \MyENA\RGW\Models\UserInfo $user */
        /** @var \MyENA\RGW\Error $err */
        [$user, $err] = self::$client
            ->User()
            ->Modify(RGW_TEST_USER_FULL, [Modify::PARAM_DISPLAY_NAME => 'something else'])
            ->execute();
        $this->assertNull($err);
        $this->assertInstanceOf(UserInfo::class, $user);
    }

    /**
     * @depends testCanCreateUser
     */
    public function testCanDeleteUser(): void
    {
        /** @var \MyENA\RGW\Error $err */
        [$_, $err] = self::$client->User()->Delete(RGW_TEST_USER_FULL)->execute();
        $this->assertNull($err);
        $this->assertNull($_);
    }
}