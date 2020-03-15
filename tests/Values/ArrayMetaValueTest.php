<?php

namespace MetaData\Values;

use PHPUnit\Framework\TestCase;

class ArrayMetaValueTest extends TestCase
{
    public function testArrayOfStrings()
    {
        $values = ['a', 'b', 'c'];
        $array = new ArrayMetaValue($values);

        $this->assertIsArray($array->get());
        foreach ($array->get() as $key => $value) {
            $this->assertIsString($value->get());
            $this->assertEquals($values[$key], $value->get());
        }
    }

    public function testArrayOfIntegers()
    {
        $values = [1, 2, 3];
        $array = new ArrayMetaValue($values);

        $this->assertIsArray($array->get());
        foreach ($array->get() as $key => $value) {
            $this->assertIsInt($value->get());
            $this->assertEquals($values[$key], $value->get());
        }
    }

    public function testArrayOfFloats()
    {
        $values = [1.04, 2.45, 3.14, -123.4];
        $array = new ArrayMetaValue($values);

        $this->assertIsArray($array->get());
        foreach ($array->get() as $key => $value) {
            $this->assertIsFloat($value->get());
            $this->assertEquals($values[$key], $value->get());
        }
    }

    public function testArrayOfNumbers()
    {
        $values = [0.45, 3.14, 0, -1, 7];
        $array = new ArrayMetaValue($values);

        $this->assertIsArray($array->get());
        foreach ($array->get() as $key => $value) {
            $this->assertIsNumeric($value->get());
            $this->assertEquals($values[$key], $value->get());
        }
    }

    public function testArrayOfScalars()
    {
        $values = ['Abc', 3.14, -1, 0, 'toast'];
        $array = new ArrayMetaValue($values);

        $this->assertIsArray($array->get());
        foreach ($array->get() as $key => $value) {
            $this->assertIsScalar($value->get());
            $this->assertEquals($values[$key], $value->get());
        }
    }

    public function testArrayOfArrays()
    {
        $values = [[], [], []];
        $array = new ArrayMetaValue($values);

        $this->assertIsArray($array->get());
        foreach ($array->get() as $key => $value) {
            $this->assertIsArray($value->get());
            $this->assertEquals($values[$key], $value->get());
        }
    }

    public function testArrayOfNestedArrays()
    {
        $values = [ [[]], [[]], [[]] ];
        $array = new ArrayMetaValue($values);

        $this->assertIsArray($array->get());
        foreach ($array->get() as $key => $value) {
            $this->assertIsArray($value->get());
            foreach ($value->get() as $innerKey => $innerValue) {
                $this->assertEquals($values[$key][$innerKey], $innerValue->get());
            }
        }
    }

    public function testArrayOfMixed()
    {
        $values = [0.45, 3.14, 0, -1, 7, ['a' => 'def', 'b' => 123]];
        $array = new ArrayMetaValue($values);

        $this->assertIsArray($array->get());
        foreach ($array->get() as $key => $value) {
            if (is_array($value->get())) {
                foreach ($value->get() as $innerKey => $innerValue) {
                    $this->assertEquals($values[$key][$innerKey], $innerValue->get());
                }
            } else {
                $this->assertIsScalar($value->get());
                $this->assertEquals($values[$key], $value->get());
            }
        }
    }
}
