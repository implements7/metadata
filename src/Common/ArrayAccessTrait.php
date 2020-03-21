<?php declare(strict_types=1);

namespace MetaData\Common;

trait ArrayAccessTrait
{
    protected array $offsets = [];

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->offsets);
    }

    public function offsetGet($offset)
    {
        return $this->offsets[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->offsets[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->offsets[$offset]);
    }

    public function setOffsets(array $offsets): void
    {
        $this->offsets = $offsets;
    }
}