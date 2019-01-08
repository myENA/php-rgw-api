<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModelCollection;

/**
 * @OA\Schema(
 *     schema="RGWBucketInfoCollection",
 *     type="array",
 *     @OA\Items(
 *          allOf={
 *              @OA\Schema(ref="#/components/schemas/RGWBucketInfo")
 *          }
 *     )
 * )
 */

/**
 * Class BucketInfoCollection
 * @package MyENA\RGW\Models
 */
class BucketInfoCollection extends AbstractModelCollection
{
    /**
     * @return string
     */
    protected function containedType(): string
    {
        return BucketInfo::class;
    }
}