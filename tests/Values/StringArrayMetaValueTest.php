<?php

namespace MetaData\Values;

use PHPUnit\Framework\TestCase;

class StringArrayMetaValueTest extends TestCase
{
    public function testGet()
    {
        $values = ['a', 'b', 'c'];
        $array = new StringArrayMetaValue($values);

        $this->assertIsArray($array->get());
        foreach ($array->get() as $key => $value) {
            $this->assertIsString($value->get());
            $this->assertEquals($values[$key], $value->get());
        }
    }
}
