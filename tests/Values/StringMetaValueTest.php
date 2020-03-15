<?php

namespace MetaData\Values;

use PHPUnit\Framework\TestCase;

class StringMetaValueTest extends TestCase
{
    public function testGet()
    {
        $value = 'testString';
        $string = new StringMetaValue($value);
        $this->assertEquals($value, $string->get());
    }
}
