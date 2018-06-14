<?php namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @SWG\Definition(
 *     definition="RGWStatisticsEntry",
 *     type="object",
 *     @SWG\Property(
 *          property="size_kb",
 *          type="integer"
 *     ),
 *     @SWG\Property(
 *          property="size_kb_actual",
 *          type="integer"
 *     ),
 *     @SWG\Property(
 *          property="num_objects",
 *          type="integer"
 *     ),
 *     @SWG\Property(
 *          property="size",
 *          type="integer"
 *     ),
 *     @SWG\Property(
 *          property="size_actual",
 *          type="integer"
 *     ),
 *     @SWG\Property(
 *          property="size_utilized",
 *          type="integer"
 *     ),
 *     @SWG\Property(
 *          property="size_kb_utilized",
 *          type="integer"
 *     )
 * )
 */

/**
 * Class StatisticsEntry
 * @package MyENA\RGW\Models
 */
class StatisticsEntry extends AbstractModel {
    /** @var int */
    protected $sizeKb = 0;
    /** @var int */
    protected $sizeKbActual = 0;
    /** @var int */
    protected $numObjects = 0;
    /** @var int */
    protected $size = 0;
    /** @var int */
    protected $sizeActual = 0;
    /** @var int */
    protected $sizeUtilized = 0;
    /** @var int */
    protected $sizeKbUtilized = 0;

    /**
     * @return int
     */
    public function getSizeKb(): int {
        return $this->sizeKb;
    }

    /**
     * @return int
     */
    public function getSizeKbActual(): int {
        return $this->sizeKbActual;
    }

    /**
     * @return int
     */
    public function getNumObjects(): int {
        return $this->numObjects;
    }

    /**
     * @return int
     */
    public function getSize(): int {
        return $this->size;
    }

    /**
     * @return int
     */
    public function getSizeActual(): int {
        return $this->sizeActual;
    }

    /**
     * @return int
     */
    public function getSizeUtilized(): int {
        return $this->sizeUtilized;
    }

    /**
     * @return int
     */
    public function getSizeKbUtilized(): int {
        return $this->sizeKbUtilized;
    }
}