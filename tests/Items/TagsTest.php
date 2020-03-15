<?php

namespace MetaData\Items;

use MetaData\MetaDataBox;
use MetaData\Packers\ArrayPacker;
use MetaData\Values\StringMetaValue;
use PHPUnit\Framework\TestCase;

class TagsTest extends TestCase
{
    public function testGetName()
    {
        $name = 'tags';
        $tags = new Tags($name);
        $this->assertEquals($name, $tags->getName());
    }

    public function testGetValue()
    {
        $name = 'tags';
        $tags = new Tags($name);
        $this->assertIsArray($tags->getValue()->get());
    }

    public function testAdd()
    {
        $name = 'tags';
        $tags = new Tags($name);

        $expected = ['php', 'frameworks', 'testing'];
        foreach ($expected as $tag) {
            $tags->add($tag);
        }

        $this->assertIsArray($tags->getValue()->get());
        $this->assertCount(count($expected), $tags->getValue()->get());
        foreach ($tags->getValue()->get() as $key => $tag) {
            $this->assertInstanceOf(StringMetaValue::class, $tag);
            $this->assertEquals($expected[$key], $tag->get());
        }
    }

    public function testDuplicateTags()
    {
        $name = 'tags';
        $tags = new Tags($name);

        $expected = ['php', 'frameworks', 'testing', 'php', 'frameworks'];
        foreach ($expected as $tag) {
            $tags->add($tag);
        }

        $this->assertIsArray($tags->getValue()->get());
        $this->assertCount(count($expected), $tags->getValue()->get());
        foreach ($tags->getValue()->get() as $key => $tag) {
            $this->assertInstanceOf(StringMetaValue::class, $tag);
            $this->assertEquals($expected[$key], $tag->get());
        }
    }
}
