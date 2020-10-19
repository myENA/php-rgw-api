<?php declare(strict_types=1);

namespace MyENA\RGW\Tests\Chain\User;

use MyENA\RGW\Chain\User\Create;
use MyENA\RGW\Tests\Chain\AbstractLinkTestCase;

/**
 * Class CreateTest
 * @package MyENA\RGW\Tests\Chain\User
 */
class CreateParameterTest extends AbstractLinkTestCase
{
    /**
     * @param array $opt
     * @return \MyENA\RGW\Chain\User\Create
     */
    private function getValidCreate(array $opt = []): Create
    {
        return self::$client->User()->Create(RGW_TEST_USER_UID, RGW_TEST_USER_DISPLAY_NAME, $opt);
    }

    public function testCanPassValidUIDAndDisplayName(): void
    {
        $create = $this->getValidCreate();
        $this->assertInstanceOf(Create::class, $create);
    }

    public function testExceptionThrownWhenUIDEmpty(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        self::$client->User()->Create('', RGW_TEST_USER_DISPLAY_NAME);
    }

    public function testExceptionThrownWhenDisplayNameEmpty(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        self::$client->User()->Create(RGW_TEST_USER_UID, '');
    }

    public function testExceptionThrownWhenTenantInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->getValidCreate([Create::PARAM_TENANT => 'cheeze1241354&~(!*~(@']);
    }


    public function testCanPassValidTenant(): void
    {
        $create = $this->getValidCreate([Create::PARAM_TENANT => RGW_TEST_TENANT]);
        $this->assertInstanceOf(Create::class, $create);
    }

    public function testExceptionThrownWhenEmailInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->getValidCreate([Create::PARAM_EMAIL => 'whatever!$#!']);
    }

    public function testCanPassValidEmail(): void
    {
        $create = $this->getValidCreate([Create::PARAM_EMAIL => RGW_TEST_USER_EMAIL]);
        $this->assertInstanceOf(Create::class, $create);
    }

    public function testExceptionThrownWhenKeyTypeInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->getValidCreate([Create::PARAM_KEY_TYPE => 'whatever']);
    }

    public function testCanPassValidKeyType(): void
    {
        $create = $this->getValidCreate([Create::PARAM_KEY_TYPE => 's3']);
        $this->assertInstanceOf(Create::class, $create);
    }

    public function testExceptionThrownWhenAccessKeyInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->getValidCreate([Create::PARAM_ACCESS_KEY => 1234]);
    }

    public function testCanPassValidAccessKey(): void
    {
        $create = $this->getValidCreate([Create::PARAM_ACCESS_KEY => '1234']);
        $this->assertInstanceOf(Create::class, $create);
    }

    public function testExceptionThrownWhenSecretKeyInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->getValidCreate([Create::PARAM_SECRET_KEY => 1234]);
    }

    public function testCanPassValidSecretKey(): void
    {
        $create = $this->getValidCreate([Create::PARAM_SECRET_KEY => '1234']);
        $this->assertInstanceOf(Create::class, $create);
    }

    public function testExceptionThrownWhenGenerateKeyInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->getValidCreate([Create::PARAM_GENERATE_KEY => 'whatever']);
    }

    public function testCanPassValidGenerateKey(): void
    {
        $create = $this->getValidCreate([Create::PARAM_GENERATE_KEY => false]);
        $this->assertInstanceOf(Create::class, $create);
    }

    public function testExceptionThrownWhenMaxBucketsInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->getValidCreate([Create::PARAM_MAX_BUCKETS => 'seven']);
    }

    public function testCanPassValidMaxBuckets(): void
    {
        $create = $this->getValidCreate([Create::PARAM_MAX_BUCKETS => 1]);
        $this->assertInstanceOf(Create::class, $create);
    }

    public function testExceptionThrownWhenSuspendedInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->getValidCreate([Create::PARAM_SUSPENDED => 'whatever']);
    }

    public function testCanPassValidSuspended(): void
    {
        $create = $this->getValidCreate([Create::PARAM_SUSPENDED => false]);
        $this->assertInstanceOf(Create::class, $create);
    }
}
