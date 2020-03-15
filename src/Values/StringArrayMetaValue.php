<?php declare(strict_types=1);

namespace MetaData\Values;

use MetaData\MetaValueInterface;

class StringArrayMetaValue implements MetaValueInterface
{
    private array $strings = [];

    public function __construct(array $values)
    {
        foreach ($values as $key => $value) {
            $this->strings[$key] = new StringMetaValue($value);
        }
    }

    public function get(): array
    {
        return $this->strings;
    }
}