<?php declare(strict_types=1);

namespace MetaData\Values;

use MetaData\MetaValueInterface;

abstract class ScalarMetaValue implements MetaValueInterface
{
    protected string $value;

    public function __construct($value)
    {
        if (!is_scalar($value)) {
            throw new \MetaValueTypeException('Value must be a scalar');
        }

        $this->value = $value;
    }

    public function get()
    {
        return $this->value;
    }
}