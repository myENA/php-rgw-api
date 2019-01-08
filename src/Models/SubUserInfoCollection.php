<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModelCollection;

/**
 * @OA\Schema(
 *     schema="RGWSubUserInfoCollection",
 *     type="array",
 *     @OA\Items(
 *          @OA\Schema(ref="#/components/schemas/RGWSubUserInfo")
 *     )
 * )
 */

/**
 * Class SubUserInfoCollection
 * @package MyENA\RGW\Models
 */
class SubUserInfoCollection extends AbstractModelCollection
{
    /**
     * @return string
     */
    protected function containedType(): string
    {
        return SubUserInfo::class;
    }
}
