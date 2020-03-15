<?php declare(strict_types=1);

namespace MetaData\Values;

use MetaData\MetaValueInterface;

class ArrayMetaValue implements MetaValueInterface
{
    private array $strings = [];

    public function __construct(array $values)
    {
        foreach ($values as $key => $value) {
            $this->strings[$key] = $this->factoryValueByType($value);
        }
    }

    private function factoryValueByType($value): MetaValueInterface
    {
        switch (gettype($value)) {
            case 'string':
                return new StringMetaValue($value);
            case 'double':
                return new FloatMetaValue($value);
            case 'integer':
                return new IntegerMetaValue($value);
            case 'array':
                return new ArrayMetaValue($value);
            default:
                throw new \MetaValueTypeException('Unsupported type');
        }
    }

    public function get(): array
    {
        return $this->strings;
    }
}