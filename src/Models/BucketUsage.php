<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="RGWBucketUsage",
 *     type="object",
 *     @OA\Property(
 *          property="rgw_none",
 *          type="object",
 *          ref="#/components/schemas/RGWStatisticsEntry"
 *     ),
 *     @OA\Property(
 *          property="rgw_main",
 *          type="object",
 *          ref="#/components/schemas/RGWStatisticsEntry"
 *     ),
 *     @OA\Property(
 *          property="rgw_shadow",
 *          type="object",
 *          ref="#/components/schemas/RGWStatisticsEntry"
 *     ),
 *     @OA\Property(
 *          property="rgw_multimedia",
 *          type="object",
 *          ref="#/components/schemas/RGWStatisticsEntry"
 *     )
 * )
 */

/**
 * Class BucketUsage
 * @package MyENA\RGW\Models
 */
class BucketUsage extends AbstractModel
{
    /** @var \MyENA\RGW\Models\StatisticsEntry */
    protected $rgwNone = null;
    /** @var \MyENA\RGW\Models\StatisticsEntry */
    protected $rgwMain = null;
    /** @var \MyENA\RGW\Models\StatisticsEntry */
    protected $rgwShadow = null;
    /** @var \MyENA\RGW\Models\StatisticsEntry */
    protected $rgwMultimeta = null;

    /**
     * BucketUsage constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (is_array($this->rgwNone)) {
            $this->rgwNone = new StatisticsEntry($this->rgwNone);
        }
        if (is_array($this->rgwMain)) {
            $this->rgwMain = new StatisticsEntry($this->rgwMain);
        }
        if (is_array($this->rgwShadow)) {
            $this->rgwShadow = new StatisticsEntry($this->rgwShadow);
        }
        if (is_array($this->rgwMultimeta)) {
            $this->rgwMultimeta = new StatisticsEntry($this->rgwMultimeta);
        }
    }

    /**
     * @return string
     */
    public function _getKeyDelimiter(): string
    {
        return '.';
    }

    /**
     * @return \MyENA\RGW\Models\StatisticsEntry
     */
    public function getRgwNone(): ?StatisticsEntry
    {
        return $this->rgwNone;
    }

    /**
     * @return \MyENA\RGW\Models\StatisticsEntry
     */
    public function getRgwMain(): ?StatisticsEntry
    {
        return $this->rgwMain;
    }

    /**
     * @return \MyENA\RGW\Models\StatisticsEntry
     */
    public function getRgwShadow(): ?StatisticsEntry
    {
        return $this->rgwShadow;
    }

    /**
     * @return \MyENA\RGW\Models\StatisticsEntry
     */
    public function getRgwMultimeta(): ?StatisticsEntry
    {
        return $this->rgwMultimeta;
    }
}