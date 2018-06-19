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

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^(Parameter uid failed not-empty validator with value: "")/
     */
    public function testExceptionThrownWhenUIDEmpty(): void
    {
        self::$client->User()->Create('', RGW_TEST_USER_DISPLAY_NAME);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^(Parameter display-name failed not-empty validator with value: "")/
     */
    public function testExceptionThrownWhenDisplayNameEmpty(): void
    {
        self::$client->User()->Create(RGW_TEST_USER_UID, '');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^(Parameter tenant failed tenant validator with value: "cheeze1241354&~\(\!\*~\(@")/
     */
    public function testExceptionThrownWhenTenantInvalid(): void
    {
        $this->getValidCreate([Create::PARAM_TENANT => 'cheeze1241354&~(!*~(@']);
    }


    public function testCanPassValidTenant(): void
    {
        $create = $this->getValidCreate([Create::PARAM_TENANT => RGW_TEST_TENANT]);
        $this->assertInstanceOf(Create::class, $create);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^(Parameter email failed email validator with value: "whatever!\$#!")/
     */
    public function testExceptionThrownWhenEmailInvalid(): void
    {
        $this->getValidCreate([Create::PARAM_EMAIL => 'whatever!$#!']);
    }

    public function testCanPassValidEmail(): void
    {
        $create = $this->getValidCreate([Create::PARAM_EMAIL => RGW_TEST_USER_EMAIL]);
        $this->assertInstanceOf(Create::class, $create);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^(Parameter key-type failed one-of validator with value: "whatever")/
     */
    public function testExceptionThrownWhenKeyTypeInvalid(): void
    {
        $this->getValidCreate([Create::PARAM_KEY_TYPE => 'whatever']);
    }

    public function testCanPassValidKeyType(): void
    {
        $create = $this->getValidCreate([Create::PARAM_KEY_TYPE => 's3']);
        $this->assertInstanceOf(Create::class, $create);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^(Parameter access-key failed string validator with value: 1234)/
     */
    public function testExceptionThrownWhenAccessKeyInvalid(): void
    {
        $this->getValidCreate([Create::PARAM_ACCESS_KEY => 1234]);
    }

    public function testCanPassValidAccessKey(): void
    {
        $create = $this->getValidCreate([Create::PARAM_ACCESS_KEY => '1234']);
        $this->assertInstanceOf(Create::class, $create);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^(Parameter secret-key failed string validator with value: 1234)/
     */
    public function testExceptionThrownWhenSecretKeyInvalid(): void
    {
        $this->getValidCreate([Create::PARAM_SECRET_KEY => 1234]);
    }

    public function testCanPassValidSecretKey(): void
    {
        $create = $this->getValidCreate([Create::PARAM_SECRET_KEY => '1234']);
        $this->assertInstanceOf(Create::class, $create);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^(Parameter generate-key failed boolean validator with value: "whatever")/
     */
    public function testExceptionThrownWhenGenerateKeyInvalid(): void
    {
        $this->getValidCreate([Create::PARAM_GENERATE_KEY => 'whatever']);
    }

    public function testCanPassValidGenerateKey(): void
    {
        $create = $this->getValidCreate([Create::PARAM_GENERATE_KEY => false]);
        $this->assertInstanceOf(Create::class, $create);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^(Parameter max-buckets failed integer validator with value: "seven")/
     */
    public function testExceptionThrownWhenMaxBucketsInvalid(): void
    {
        $this->getValidCreate([Create::PARAM_MAX_BUCKETS => 'seven']);
    }

    public function testCanPassValidMaxBuckets(): void
    {
        $create = $this->getValidCreate([Create::PARAM_MAX_BUCKETS => 1]);
        $this->assertInstanceOf(Create::class, $create);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessageRegExp /^(Parameter suspended failed boolean validator with value: "whatever")/
     */
    public function testExceptionThrownWhenSuspendedInvalid(): void
    {
        $this->getValidCreate([Create::PARAM_SUSPENDED => 'whatever']);
    }

    public function testCanPassValidSuspended(): void
    {
        $create = $this->getValidCreate([Create::PARAM_SUSPENDED => false]);
        $this->assertInstanceOf(Create::class, $create);
    }
}
