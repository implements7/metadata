<?php

namespace MetaData\Filters;

use MetaData\Values\ArrayMetaValue;
use PHPUnit\Framework\TestCase;

class UniqueArrayTest extends TestCase
{
    public function testGetFiltered()
    {
        $data = [1, 9, 7, 2, 'A', 'B', 'B', 'A', 1, 9, 8, 2];
        $array = new ArrayMetaValue($data);
        $filter = new UniqueArray();
        $filter->setValue($array);

        $filtered = $filter->getFiltered();
        $this->assertIsArray($filtered->get());

        $filteredArray = [];
        foreach ($filtered->get() as $value) {
            $filteredArray[] = $value->get();
        }

        $expected = array_values(array_unique($data));
        $this->assertEquals($expected, $filteredArray);
    }
}
