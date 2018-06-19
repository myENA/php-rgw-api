<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModelCollection;

/**
 * @SWG\Definition(
 *     definition="RGWUserCapabilityCollection",
 *     type="array",
 *     @SWG\Items(ref="#/definitions/RGWUserCapability")
 * )
 */

/**
 * Class UserCapabilityCollection
 * @package MyENA\RGW\Models
 */
class UserCapabilityCollection extends AbstractModelCollection
{
    /**
     * @return string
     */
    protected function containedType(): string
    {
        return UserCapability::class;
    }
}