<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="RGWMetadataResponse",
 *     type="object",
 *     @OA\Property(
 *          property="key",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="mtime",
 *          type="string"
 *     ),
 *     @OA\Property(
 *          property="ver",
 *          type="object",
 *          ref="#/components/schemas/RGWMetadataVersion"
 *     )
 * )
 */

/**
 * Class AbstractMetadataResponse
 * @package MyENA\RGW\Models
 */
abstract class AbstractMetadataResponse extends AbstractModel
{
    /** @var string */
    protected $key = '';
    /** @var string */
    protected $mtime = '';
    /** @var \MyENA\RGW\Models\MetadataVersion */
    protected $ver = null;

    /**
     * AbstractMetadataModel constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (is_array($this->ver)) {
            $this->ver = new MetadataVersion($this->ver);
        }
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getMtime(): string
    {
        return $this->mtime;
    }

    /**
     * @return \MyENA\RGW\Models\MetadataVersion
     */
    public function getVer(): ?MetadataVersion
    {
        return $this->ver;
    }
}