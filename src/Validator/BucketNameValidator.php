<?php declare(strict_types=1);

namespace MyENA\RGW\Validator;

use MyENA\RGW\Validator;

/**
 * Class BucketNameValidator
 * @package MyENA\RGW\Validator
 */
class BucketNameValidator implements Validator
{
    public const NAME = 'bucket-name';

    // TODO: improve to test for ip addresses.
    public const TEST_REGEX = '/^([a-zA-Z0-9_]+\/)?[a-z0-9][a-z0-9-\.]{2,62}$/';

    /**
     * @return string
     */
    public function name(): string
    {
        return self::NAME;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function test($value): bool
    {
        return is_string($value) && (bool)preg_match(self::TEST_REGEX, $value);
    }

    /**
     * @return string
     */
    public function expectedStatement(): string
    {
        return 'string conforming to ' . self::TEST_REGEX;
    }
}