<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="RGWUsageInfoResponse",
 *     type="object",
 *     @OA\Property(
 *          property="entries",
 *          type="array",
 *          @OA\Items(
 *              @OA\Schema(ref="#/components/schemas/RGWUsageInfoEntry")
 *          )
 *     ),
 *     @OA\Property(
 *          property="summary",
 *          type="array",
 *          @OA\Items(
 *              @OA\Schema(ref="#/components/schemas/RGWUsageInfoSummary")
 *          )
 *     )
 * )
 */

/**
 * Class UsageInfoResponse
 * @package MyENA\RGW\Models
 */
class UsageInfoResponse extends AbstractModel
{
    /** @var \MyENA\RGW\Models\UsageInfoEntry[] */
    protected $entries = null;
    /** @var \MyENA\RGW\Models\UsageInfoSummary[] */
    protected $summary = null;

    /**
     * UsageInfoResponse constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (is_array($this->entries)) {
            foreach ($this->entries as &$entry) {
                $entry = new UsageInfoEntry($entry);
            }
        }
        if (is_array($this->summary)) {
            foreach ($this->summary as &$summary) {
                $summary = new UsageInfoSummary($summary);
            }
        }
    }

    /**
     * @return \MyENA\RGW\Models\UsageInfoEntry[]
     */
    public function getEntries(): array
    {
        return $this->entries;
    }

    /**
     * @return \MyENA\RGW\Models\UsageInfoSummary[]
     */
    public function getSummary(): array
    {
        return $this->summary;
    }
}