<?php

namespace MetaData\Items;

use MetaData\Filters\UniqueArray;
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

    public function testAppend()
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

    public function testFilterDuplicateTags()
    {
        $name = 'tags';
        $tags = new Tags($name);

        $data = ['php', 'frameworks', 'testing', 'php', 'frameworks'];
        foreach ($data as $tag) {
            $tags->add($tag);
        }

        $filter = new UniqueArray();
        $tags->addFilter($filter);
        $tags->filterValues();

        $this->assertIsArray($tags->getValue()->get());
        $this->assertCount(count(array_unique($data)), $tags->getValue()->get());
        foreach ($tags->getValue()->get() as $key => $tag) {
            $this->assertInstanceOf(StringMetaValue::class, $tag);
            $this->assertEquals($data[$key], $tag->get());
        }
    }
}
