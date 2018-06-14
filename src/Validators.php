<?php namespace MyENA\RGW;

use MyENA\RGW\Validator\BooleanValidator;
use MyENA\RGW\Validator\BucketNameValidator;
use MyENA\RGW\Validator\CustomValidator;
use MyENA\RGW\Validator\EmailValidator;
use MyENA\RGW\Validator\InstanceOfValidator;
use MyENA\RGW\Validator\IntegerValidator;
use MyENA\RGW\Validator\IPv4Validator;
use MyENA\RGW\Validator\MACValidator;
use MyENA\RGW\Validator\OneOfValidator;
use MyENA\RGW\Validator\RequiredValidator;
use MyENA\RGW\Validator\StringValidator;
use MyENA\RGW\Validator\TenantNameValidator;
use MyENA\RGW\Validator\UserCapabilityValidator;

/**
 * Class Validators
 * @package MyENA\RGW\Request\Parameter
 */
abstract class Validators {
    /** @var \MyENA\RGW\Validator\RequiredValidator */
    private static $required;

    /** @var \MyENA\RGW\Validator\StringValidator */
    private static $string;
    /** @var \MyENA\RGW\Validator\IntegerValidator */
    private static $integer;
    /** @var \MyENA\RGW\Validator\BooleanValidator */
    private static $boolean;

    /** @var \MyENA\RGW\Validator\IPv4Validator */
    private static $ipv4;
    /** @var \MyENA\RGW\Validator\MACValidator */
    private static $mac;
    /** @var \MyENA\RGW\Validator\EmailValidator */
    private static $email;
    /** @var \MyENA\RGW\Validator\TenantNameValidator */
    private static $tenantName;
    /** @var \MyENA\RGW\Validator\UserCapabilityValidator */
    private static $userCapability;
    /** @var \MyENA\RGW\Validator\BucketNameValidator */
    private static $bucketName;

    /**
     * @return \MyENA\RGW\Validator\RequiredValidator
     */
    public static function Required(): RequiredValidator {
        if (!isset(self::$required)) {
            self::$required = new RequiredValidator();
        }
        return self::$required;
    }

    /**
     * @return \MyENA\RGW\Validator\StringValidator
     */
    public static function String(): StringValidator {
        if (!isset(self::$string)) {
            self::$string = new StringValidator();
        }
        return self::$string;
    }

    /**
     * @return \MyENA\RGW\Validator\IntegerValidator
     */
    public static function Integer(): IntegerValidator {
        if (!isset(self::$integer)) {
            self::$integer = new IntegerValidator();
        }
        return self::$integer;
    }

    /**
     * @return \MyENA\RGW\Validator\IntegerValidator
     */
    public static function Int(): IntegerValidator {
        return self::Integer();
    }

    /**
     * @return \MyENA\RGW\Validator\BooleanValidator
     */
    public static function Boolean(): BooleanValidator {
        if (!isset(self::$boolean)) {
            self::$boolean = new BooleanValidator();
        }
        return self::$boolean;
    }

    /**
     * @return \MyENA\RGW\Validator\BooleanValidator
     */
    public static function Bool(): BooleanValidator {
        return self::Boolean();
    }

    /**
     * @return \MyENA\RGW\Validator\IPv4Validator
     */
    public static function IPv4(): IPv4Validator {
        if (!isset(self::$ipv4)) {
            self::$ipv4 = new IPv4Validator();
        }
        return self::$ipv4;
    }

    /**
     * @return \MyENA\RGW\Validator\MACValidator
     */
    public static function MAC(): MACValidator {
        if (!isset(self::$mac)) {
            self::$mac = new MACValidator();
        }
        return self::$mac;
    }

    /**
     * @return \MyENA\RGW\Validator\EmailValidator
     */
    public static function Email(): EmailValidator {
        if (!isset(self::$email)) {
            self::$email = new EmailValidator();
        }
        return self::$email;
    }

    /**
     * @return \MyENA\RGW\Validator\TenantNameValidator
     */
    public static function TenantName(): TenantNameValidator {
        if (!isset(self::$tenantName)) {
            self::$tenantName = new TenantNameValidator();
        }
        return self::$tenantName;
    }

    /**
     * @return \MyENA\RGW\Validator\UserCapabilityValidator
     */
    public static function UserCapability(): UserCapabilityValidator {
        if (!isset(self::$userCapability)) {
            self::$userCapability = new UserCapabilityValidator();
        }
        return self::$userCapability;
    }

    /**
     * @return \MyENA\RGW\Validator\BucketNameValidator
     */
    public static function BucketName(): BucketNameValidator {
        if (!isset(self::$bucketName)) {
            self::$bucketName = new BucketNameValidator();
        }
        return self::$bucketName;
    }

    /**
     * @param mixed ...$values
     * @return \MyENA\RGW\Validator\OneOfValidator
     */
    public static function OneOf(...$values): OneOfValidator {
        return new OneOfValidator($values);
    }

    /**
     * @param string $class
     * @return \MyENA\RGW\Validator\InstanceOfValidator
     */
    public static function InstanceOf(string $class): InstanceOfValidator {
        return new InstanceOfValidator($class);
    }

    /**
     * @param string $name
     * @param        $callable
     * @return \MyENA\RGW\Validator\CustomValidator
     */
    public static function Custom(string $name, $callable): CustomValidator {
        return new CustomValidator($name, $callable);
    }
}