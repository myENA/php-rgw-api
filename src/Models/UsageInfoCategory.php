<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="RGWUsageInfoCategory",
 *     type="object",
 *     @OA\Property(
 *          property="category",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="bytes_sent",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="bytes_received",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="ops",
 *          type="integer"
 *     ),
 *     @OA\Property(
 *          property="successful_ops",
 *          type="integer"
 *     )
 * )
 */

/**
 * Class UsageInfoCategory
 * @package MyENA\RGW\Models
 */
class UsageInfoCategory extends AbstractModel
{
    /** @var string */
    protected $category = '';
    /** @var int */
    protected $bytesSent = 0;
    /** @var int */
    protected $bytesReceived = 0;
    /** @var int */
    protected $ops = 0;
    /** @var int */
    protected $successfulOps = 0;

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return int
     */
    public function getBytesSent(): int
    {
        return $this->bytesSent;
    }

    /**
     * @return int
     */
    public function getBytesReceived(): int
    {
        return $this->bytesReceived;
    }

    /**
     * @return int
     */
    public function getOps(): int
    {
        return $this->ops;
    }

    /**
     * @return int
     */
    public function getSuccessfulOps(): int
    {
        return $this->successfulOps;
    }
}