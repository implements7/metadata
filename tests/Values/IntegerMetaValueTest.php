<?php declare(strict_types=1);

namespace MetaData\Values;

use PHPUnit\Framework\TestCase;

class IntegerMetaValueTest extends TestCase
{
    public function testGet()
    {
        $value = PHP_INT_MAX;
        $integer = new IntegerMetaValue($value);
        $this->assertEquals($value, $integer->get());

        $value = -1234;
        $integer = new IntegerMetaValue($value);
        $this->assertEquals($value, $integer->get());

        $value = 0;
        $integer = new IntegerMetaValue($value);
        $this->assertEquals($value, $integer->get());

        $value = 0x1234;
        $integer = new IntegerMetaValue($value);
        $this->assertEquals($value, $integer->get());

        $value = 0b10101010;
        $integer = new IntegerMetaValue($value);
        $this->assertEquals($value, $integer->get());
    }
}
