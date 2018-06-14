<?php namespace MyENA\RGW;

use Psr\Http\Message\ResponseInterface;

/**
 * Class AbstractModel
 * @package MyENA\RGW
 */
abstract class AbstractModel implements \JsonSerializable {
    /**
     * AbstractModel constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        $d = $this->_getKeyDelimiter();
        foreach ($data as $k => $v) {
            $this->{sanitizeName($k, $d, true)} = $v;
        }
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return array(
     * @type static Decoded response, if no errors were seen
     * @type \MyENA\RGW\Error Error description, if encountered
     * )
     */
    public static function fromPSR7Response(ResponseInterface $response): array {
        [$decoded, $err] = decodeBody($response, true);
        if (null !== $err) {
            return [null, $err];
        }

        if (null === $decoded) {
            return [new static(), null];
        }

        return [new static($decoded), null];
    }

    /**
     * @return string
     */
    public function _getKeyDelimiter(): string {
        return '_';
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        $a = [];
        $d = $this->_getKeyDelimiter();
        foreach (get_object_vars($this) as $k => $v) {
            $a[desanitizeName($k, $d)] = $v;
        }
        return $a;
    }
}