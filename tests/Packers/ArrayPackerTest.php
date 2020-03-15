<?php

namespace MetaData\Packers;

use MetaData\MetaItemInterface;
use MetaData\MetaValueInterface;
use PHPUnit\Framework\TestCase;

class ArrayPackerTest extends TestCase
{
    public function testPackItem()
    {
        $packer = new ArrayPacker();

        $item = $this->createMock(MetaItemInterface::class);
        $this->assertNull($packer->packItem($item));
    }

    public function testGetContents()
    {
        $packer = new ArrayPacker();

        $mockItemName = 'mockItemName';
        $mockItemValue = 'mockValue';

        $mockValue = $this->createMock(MetaValueInterface::class);
        $mockValue->method('get')->willReturn($mockItemValue);
        $item = $this->createMock(MetaItemInterface::class);
        $item->method('getName')->willReturn($mockItemName);
        $item->method('getValue')->willReturn($mockValue);

        $this->assertNull($packer->packItem($item));
        $contents = $packer->getContents();
        $this->assertIsArray($contents);
        $this->assertArrayHasKey($mockItemName, $contents);
        $this->assertEquals($mockItemValue, $contents[$mockItemName]);
    }
}
