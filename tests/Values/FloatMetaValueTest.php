<?php declare(strict_types=1);

namespace MetaData\Values;

use PHPUnit\Framework\TestCase;

class FloatMetaValueTest extends TestCase
{
    public function testGet()
    {
        $value = 3.14;
        $float = new FloatMetaValue($value);
        $this->assertEquals($value, $float->get());

        $value = 0;
        $float = new FloatMetaValue($value);
        $this->assertEquals($value, $float->get());

        $value = -100.00023;
        $float = new FloatMetaValue($value);
        $this->assertEquals($value, $float->get());
    }
}
