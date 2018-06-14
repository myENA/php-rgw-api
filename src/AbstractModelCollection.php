<?php namespace MyENA\RGW;

/**
 * Class AbstractArrayModel
 * @package MyENA\RGW
 */
abstract class AbstractModelCollection extends AbstractModel implements \Iterator, \Countable {
    /** @var array */
    private $data = [];

    /**
     * AbstractArrayResponse constructor.
     * @param array $data
     */
    public function __construct(array $data = []) {
        $class = $this->containedType();
        foreach ($data as $datum) {
            $this->data[] = new $class($datum);
        }
    }

    /**
     * Must return the fully qualified class name of the contained object
     *
     * @return string
     */
    abstract protected function containedType(): string;

    /**
     * @return mixed
     */
    public function first() {
        return $this->data[0] ?? null;
    }

    /**
     * @return mixed
     */
    public function current() {
        return current($this->data);
    }

    public function next() {
        next($this->data);
    }

    /**
     * @return int|mixed|null|string
     */
    public function key() {
        return key($this->data);
    }

    /**
     * @return bool
     */
    public function valid() {
        return null !== key($this->data);
    }

    public function rewind() {
        reset($this->data);
    }

    /**
     * @return int
     */
    public function count() {
        return count($this->data);
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        return $this->data;
    }
}