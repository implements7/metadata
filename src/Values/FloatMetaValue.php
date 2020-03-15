<?php declare(strict_types=1);

namespace MetaData\Values;

use MetaData\MetaValueInterface;

class FloatMetaValue extends ScalarMetaValue implements MetaValueInterface
{
    public function __construct(float $value)
    {
        parent::__construct($value);
    }
}