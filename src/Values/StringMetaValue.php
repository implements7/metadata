<?php declare(strict_types=1);

namespace MetaData\Values;

use MetaData\MetaValueInterface;

class StringMetaValue implements MetaValueInterface {

    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function get()
    {
        return $this->value;
    }
}