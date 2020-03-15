<?php declare(strict_types=1);

namespace MetaData\Items\Traits;

use MetaData\MetaValueInterface;
use MetaData\Values\ArrayMetaValue;

trait ArrayValueTrait
{
    protected array $values = [];

    public function getValue(): MetaValueInterface
    {
        return new ArrayMetaValue($this->values);
    }
}