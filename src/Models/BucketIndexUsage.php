<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWBucketIndexUsage",
 *     type="object",
 *     @OA\Schema(
 *         @OA\Property(
 *              property="usage",
 *              type="object",
 *              @OA\Schema(ref="#/components/schemas/RGWBucketUsage")
 *         )
 *      )
 * )
 */

/**
 * Class BucketIndexUsage
 * @package MyENA\RGW\Models
 */
class BucketIndexUsage extends AbstractModel
{
    /** @var \MyENA\RGW\Models\BucketUsage */
    protected $usage = null;

    /**
     * BucketIndexUsage constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (is_array($this->usage)) {
            $this->usage = new BucketUsage($this->usage);
        }
    }

    /**
     * @return \MyENA\RGW\Models\BucketUsage
     */
    public function getUsage(): BucketUsage
    {
        return $this->usage;
    }
}