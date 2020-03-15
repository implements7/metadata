<?php

namespace MetaData\Packers;

use MetaData\MetaItemInterface;
use MetaData\MetaValueInterface;
use PHPUnit\Framework\TestCase;

class JsonPackerTest extends TestCase
{
    public function testPackItem()
    {
        $packer = new JsonPacker();

        $item = $this->createMock(MetaItemInterface::class);
        $this->assertNull($packer->packItem($item));
    }

    public function testGetContents()
    {
        $packer = new JsonPacker();

        $mockItemName = 'mockItemName';
        $mockItemValue = 'mockValue';

        $mockValue = $this->createMock(MetaValueInterface::class);
        $mockValue->method('get')->willReturn($mockItemValue);
        $item = $this->createMock(MetaItemInterface::class);
        $item->method('getName')->willReturn($mockItemName);
        $item->method('getValue')->willReturn($mockValue);

        $this->assertNull($packer->packItem($item));
        $contents = $packer->getContents();
        $this->assertIsString($contents);
        $this->assertEquals('{"mockItemName":"mockValue"}', $contents);
        $decoded = json_decode($contents);
        $this->assertIsObject($decoded);
        $this->assertObjectHasAttribute($mockItemName, $decoded);
        $this->assertEquals($mockItemValue, $decoded->{$mockItemName});
    }
}
