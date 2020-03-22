<?php

namespace MetaData\Values;

use MetaData\MetaValueInterface;
use PHPUnit\Framework\TestCase;
use stdClass;

class ScalarMetaValueTest extends TestCase
{
    public function testSupportedTypes()
    {
        $types = ['string', 123, 123.456];
        foreach ($types as $type) {
            $value = $this->getMockForAbstractClass(ScalarMetaValue::class, [$type]);
            $this->assertInstanceOf(MetaValueInterface::class, $value);
        }
    }

    public function testUnsupportedTypes()
    {
        $types = [[], new stdClass()];
        foreach ($types as $type) {
            $this->expectException(MetaValueTypeException::class);
            $value = $this->getMockForAbstractClass(ScalarMetaValue::class, [$type]);
            $this->assertInstanceOf(MetaValueInterface::class, $value);
        }
    }

    public function testSupportedTypesReturnsExpectedType()
    {
        $types = ['string', 123, 123.456];
        foreach ($types as $type) {
            $value = $this->getMockForAbstractClass(ScalarMetaValue::class, [$type]);
            $this->assertSame($type, $value->get());
        }
    }
}
