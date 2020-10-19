<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModelCollection;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="RGWUserKeyCollection",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/RGWUserKey")
 * )
 */

/**
 * Class UserKeyCollection
 * @package MyENA\RGW\Models
 */
class UserKeyCollection extends AbstractModelCollection
{
    /**
     * @return string
     */
    protected function containedType(): string
    {
        return UserKey::class;
    }
}