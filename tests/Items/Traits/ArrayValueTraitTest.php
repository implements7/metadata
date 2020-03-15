<?php

namespace Items\Traits;

use MetaData\Items\Traits\ArrayValueTrait;
use MetaData\Values\ArrayMetaValue;
use PHPUnit\Framework\TestCase;

class ArrayValueTraitTest extends TestCase
{
    public function testGetValue()
    {
        $array = $this->getObjectForTrait(ArrayValueTrait::class);
        $this->assertInstanceOf(ArrayMetaValue::class, $array->getValue());
    }
}
