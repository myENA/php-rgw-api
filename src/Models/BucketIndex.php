<?php declare(strict_types=1);

namespace MyENA\RGW\Models;

use MyENA\RGW\AbstractModel;
use MyENA\RGW\Error\ResponseError;
use Psr\Http\Message\ResponseInterface;
use function MyENA\RGW\decodeMultiBody;

/**
 * @OA\Schema(
 *     schema="RGWBucketIndex",
 *     type="object",
 *     @OA\Property(
 *          property="new_objects",
 *          type="array",
 *          @OA\Items(type="string"),
 *     ),
 *     @OA\Property(
 *          property="headers",
 *          type="object",
 *          ref="#/components/schemas/RGWBucketIndexHeaders"
 *     )
 * )
 */

/**
 * Class BucketIndex
 * @package MyENA\RGW\Models
 */
class BucketIndex extends AbstractModel
{
    /** @var array */
    protected $newObjects = [];
    /** @var \MyENA\RGW\Models\BucketIndexHeaders */
    protected $headers = null;

    /**
     * BucketIndex constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        if (is_array($this->headers)) {
            $this->headers = new BucketIndexHeaders($this->headers);
        }
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return array(
     * @type static|null
     * @type \MyENA\RGW\Error|null
     * )
     */
    public static function fromPSR7Response(ResponseInterface $response): array
    {
        [$parts, $err] = decodeMultiBody($response, true);
        if (null !== $err) {
            return [null, $err];
        }
        if (3 !== count($parts)) {
            return [
                null,
                new ResponseError(
                    500,
                    sprintf('Expected 3 json parts, saw %d', count($parts)),
                    json_encode($parts)
                ),
            ];
        }

        // TODO: This response seems to return 3 objects but one always seems to be empty...
        return [new static(['new_objects' => $parts[0], 'headers' => $parts[2]]), null];
    }

    /**
     * @return array
     */
    public function getNewObjects(): array
    {
        return $this->newObjects;
    }

    /**
     * @return \MyENA\RGW\Models\BucketIndexHeaders
     */
    public function getHeaders(): ?BucketIndexHeaders
    {
        return $this->headers;
    }
}