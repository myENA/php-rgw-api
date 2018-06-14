<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @SWG\Definition(
 *     definition="RGWBucketPlacement",
 *     type="object",
 *     @SWG\Property(
 *          property="data_pool",
 *          type="integer"
 *     ),
 *     @SWG\Property(
 *          property="data_extra_pool",
 *          type="integer"
 *     ),
 *     @SWG\Property(
 *          property="index_pool",
 *          type="integer"
 *     )
 * )
 */

/**
 * Class BucketPlacement
 * @package MyENA\RGW\Models
 */
class BucketPlacement extends AbstractModel {
    /** @var string */
    protected $dataPool = 0;
    /** @var string */
    protected $dataExtraPool = 0;
    /** @var string */
    protected $indexPool = 0;

    /**
     * @return string
     */
    public function getDataPool(): string {
        return $this->dataPool;
    }

    /**
     * @return string
     */
    public function getDataExtraPool(): string {
        return $this->dataExtraPool;
    }

    /**
     * @return string
     */
    public function getIndexPool(): string {
        return $this->indexPool;
    }
}