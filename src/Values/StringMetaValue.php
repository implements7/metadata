<?php declare(strict_types=1);

namespace MetaData\Values;

use MetaData\MetaValueInterface;

class StringMetaValue extends ScalarMetaValue implements MetaValueInterface
{
    public function __construct(string $value)
    {
        parent::__construct($value);
    }
}