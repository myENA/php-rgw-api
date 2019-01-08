<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModelCollection;

/**
 * @OA\Schema(
 *     schema="RGWUserCapabilityCollection",
 *     type="array",
 *     @OA\Items(
 *          allOf={
 *              @OA\Schema(ref="#/components/schemas/RGWUserCapability")
 *          }
 *     )
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