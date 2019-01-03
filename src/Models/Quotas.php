<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;

/**
 * @OA\Schema(
 *     schema="RGWQuotas",
 *     type="object",
 *     @OA\Property(
 *          property="bucket_quota",
 *          type="object",
 *          ref="#/components/schemas/RGWQuotaMeta"
 *     ),
 *     @OA\Property(
 *          property="user_quota",
 *          type="object",
 *          ref="#/components/schemas/RGWQuotaMeta"
 *     )
 * )
 */

/**
 * Class Quotas
 * @package MyENA\RGW\Models
 */
class Quotas extends AbstractModel
{
    /** @var \MyENA\RGW\Models\QuotaMeta */
    protected $bucketQuota = null;
    /** @var \MyENA\RGW\Models\QuotaMeta */
    protected $userQuota = null;

    /**
     * Quotas constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (is_array($this->bucketQuota)) {
            $this->bucketQuota = new QuotaMeta($this->bucketQuota);
        }
        if (is_array($this->userQuota)) {
            $this->userQuota = new QuotaMeta($this->userQuota);
        }
    }

    /**
     * @return \MyENA\RGW\Models\QuotaMeta
     */
    public function getBucketQuota(): ?QuotaMeta
    {
        return $this->bucketQuota;
    }

    /**
     * @return \MyENA\RGW\Models\QuotaMeta
     */
    public function getUserQuota(): ?QuotaMeta
    {
        return $this->userQuota;
    }
}