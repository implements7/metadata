<?php declare(strict_types=1);

namespace MetaData\Filters;

use MetaData\MetaValueInterface;
use MetaData\Values\ArrayMetaValue;
use MetaData\Values\MetaValueTypeException;

abstract class ArrayFilterAbstract
{
    private MetaValueInterface $value;

    public function __construct()
    {
        $this->value = new ArrayMetaValue([]);
    }

    public function setValue(MetaValueInterface $value): void
    {
        if (!$value instanceof ArrayMetaValue) {
            throw new MetaValueTypeException('Unsupported type');
        }

        $this->value = $value;
    }

    public function getFiltered(): ArrayMetaValue
    {
        return $this->filter($this->value);
    }

    abstract protected function filter(ArrayMetaValue $value): ArrayMetaValue;
}