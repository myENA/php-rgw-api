<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="RGWUsageInfoSummary",
 *     type="object",
 *     @OA\Property(
 *          property="user",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="categories",
 *          type="array",
 *          @OA\Items(
 *              @OA\Schema(ref="#/components/schemas/RGWUsageInfoCategory")
 *          )
 *     ),
 *     @OA\Property(
 *          property="total",
 *          type="object",
 *          ref="#/components/schemas/RGWUsageInfoCategory"
 *     )
 * )
 */

/**
 * Class UsageInfoSummary
 * @package MyENA\RGW\Models
 */
class UsageInfoSummary extends AbstractModel
{
    /** @var string */
    protected $user = '';
    /** @var \MyENA\RGW\Models\UsageInfoCategory[] */
    protected $categories = null;
    /** @var \MyENA\RGW\Models\UsageInfoCategory */
    protected $total = null;

    /**
     * UsageInfoSummary constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (is_array($this->categories)) {
            foreach ($this->categories as &$category) {
                $category = new UsageInfoCategory($category);
            }
        }
        if (is_array($this->total)) {
            $this->total = new UsageInfoCategory($this->total);
        }
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @return \MyENA\RGW\Models\UsageInfoCategory[]
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @return \MyENA\RGW\Models\UsageInfoCategory
     */
    public function getTotal(): \MyENA\RGW\Models\UsageInfoCategory
    {
        return $this->total;
    }
}