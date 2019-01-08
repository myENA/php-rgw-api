<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWBucketPlacement",
 *     type="object",
 *     allOf={
 *          @OA\Schema(
 *              @OA\Property(
 *                  property="data_pool",
 *                  type="integer"
 *              ),
 *              @OA\Property(
 *                  property="data_extra_pool",
 *                  type="integer"
 *              ),
 *              @OA\Property(
 *                  property="index_pool",
 *                  type="integer"
 *              )
 *          )
 *      }
 * )
 */

/**
 * Class BucketPlacement
 * @package MyENA\RGW\Models
 */
class BucketPlacement extends AbstractModel
{
    /** @var string */
    protected $dataPool = 0;
    /** @var string */
    protected $dataExtraPool = 0;
    /** @var string */
    protected $indexPool = 0;

    /**
     * @return string
     */
    public function getDataPool(): string
    {
        return $this->dataPool;
    }

    /**
     * @return string
     */
    public function getDataExtraPool(): string
    {
        return $this->dataExtraPool;
    }

    /**
     * @return string
     */
    public function getIndexPool(): string
    {
        return $this->indexPool;
    }
}