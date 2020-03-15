<?php declare(strict_types=1);

use MetaData\MetaDataBox;
use MetaData\MetaItemInterface;
use MetaData\MetaPackerInterface;
use MetaData\Packers\ArrayPacker;
use PHPUnit\Framework\TestCase;

require_once dirname(__DIR__) . '/vendor/autoload.php';

class MetaDataBoxTest extends TestCase
{
    public function testAddItem()
    {
        $packer = $this->createMock(MetaPackerInterface::class);
        $box = new MetaDataBox($packer);

        $item = $this->createMock(MetaItemInterface::class);
        $this->assertNull($box->addItem($item));
    }

    public function testGetPackage()
    {
        $packer = $this->createMock(MetaPackerInterface::class);
        $packer->method('getContents')->willReturn([]);

        $box = new MetaDataBox($packer);

        $this->assertIsArray($box->getPackage());
    }

    public function testGetPackageUsingArrayPackerAndStringValue()
    {
        $value = 'testString';
        $name = 'testName';

        $packer = new ArrayPacker();
        $box = new MetaDataBox($packer);

        $item = $this->createMock(MetaItemInterface::class);
        $item->method('getName')->willReturn($name);
        $string = new \MetaData\Values\StringMetaValue($value);
        $item->method('getValue')->willReturn($string);

        $box->addItem($item);
        $contents = $box->getPackage();
        $this->assertIsArray($contents);
        $this->assertArrayHasKey($name, $contents);
        $this->assertEquals($value, $contents[$name]);
    }
}
