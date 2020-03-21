<?php declare(strict_types=1);

namespace MetaData\Items;

use MetaData\Values\IntegerMetaValue;
use PHPUnit\Framework\TestCase;

class HitsTest extends TestCase
{
    public function testGetValue()
    {
        $name = 'hits';
        $hits = new Hits($name);
        $this->assertIsArray($hits->getValue()->get());
    }

    public function testHit()
    {
        $name = 'hits';
        $hits = new Hits($name);

        $expected = ['a' => 1, 'b' => 2, 'c' => 3];
        foreach ($expected as $hit => $number) {
            for ($i = 0; $i < $number; $i++) {
                $hits->hit($hit);
            }
        }

        $this->assertIsArray($hits->getValue()->get());
        $this->assertCount(count($expected), $hits->getValue()->get());
        foreach ($hits->getValue()->get() as $hit => $count) {
            $this->assertInstanceOf(IntegerMetaValue::class, $count);
            $this->assertEquals($expected[$hit], $count->get());
        }
    }
}
