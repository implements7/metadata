<?php declare(strict_types=1);

namespace MetaData\Values;

use MetaData\MetaValueInterface;

class IntegerMetaValue extends ScalarMetaValue implements MetaValueInterface
{
    public function __construct(int $value)
    {
        parent::__construct($value);
    }
}