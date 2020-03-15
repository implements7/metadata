<?php

namespace MetaData\Items;

use MetaData\MetaDataBox;
use MetaData\MetaValueInterface;
use MetaData\Packers\ArrayPacker;
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
            $this->assertInstanceOf(MetaValueInterface::class, $tag);
            $this->assertEquals($expected[$key], $tag->get());
        }
    }

    public function testTagsInMetaDataBox()
    {
        $packer = new ArrayPacker();
        $box = new MetaDataBox($packer);

        $name = 'tags';
        $tags = new Tags($name);
        $expected = ['php', 'frameworks', 'testing'];
        foreach ($expected as $tag) {
            $tags->add($tag);
        }

        $box->addItem($tags);
        $this->assertEquals([$name => $expected], $box->getPackage());
    }

    public function testMultipleTagsInMetaDataBox()
    {
        $packer = new ArrayPacker();
        $box = new MetaDataBox($packer);

        $tests = [
            'tags' => ['php', 'frameworks', 'testing'],
            'keywords' => ['homepages', 'commands', 'websites']
        ];

        foreach ($tests as $name => $keywords) {
            $tags = new Tags($name);
            foreach ($keywords as $keyword) {
                $tags->add($keyword);
            }
            $box->addItem($tags);
        }

        $contents = $box->getPackage();
        $this->assertEquals($tests, $contents);
    }
}
