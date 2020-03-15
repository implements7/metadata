<?php declare(strict_types=1);

use MetaData\MetaDataBox;
use MetaData\MetaItemInterface;
use MetaData\MetaPackerInterface;
use MetaData\Packers\ArrayPacker;
use MetaData\Values\ArrayMetaValue;
use MetaData\Values\StringMetaValue;
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
        $string = new StringMetaValue($value);
        $item->method('getValue')->willReturn($string);

        $box->addItem($item);
        $contents = $box->getPackage();
        $this->assertIsArray($contents);
        $this->assertArrayHasKey($name, $contents);
        $this->assertEquals($value, $contents[$name]);
    }

    public function testGetPackageUsingArrayPackerAndStringArrayValue()
    {
        $values = ['a', 'b', 'c', 'd'];
        $name = 'testName';

        $packer = new ArrayPacker();
        $box = new MetaDataBox($packer);

        $item = $this->createMock(MetaItemInterface::class);
        $item->method('getName')->willReturn($name);
        $array = new ArrayMetaValue($values);
        $item->method('getValue')->willReturn($array);

        $box->addItem($item);
        $contents = $box->getPackage();
        $this->assertIsArray($contents);
        $this->assertArrayHasKey($name, $contents);
        $this->assertEquals($values, $contents[$name]);
    }

    public function testGetPackageUsingArrayPackerAndMultipleStringArrayValues()
    {
        $data = [
            'one' => ['a', 'b', 'c', 'd'],
            'two' => ['a', 'b', 'c', 'd']
        ];

        $packer = new ArrayPacker();
        $box = new MetaDataBox($packer);

        foreach ($data as $name => $values) {
            $item = $this->createMock(MetaItemInterface::class);
            $item->method('getName')->willReturn($name);
            $array = new ArrayMetaValue($values);
            $item->method('getValue')->willReturn($array);
            $box->addItem($item);
        }

        $contents = $box->getPackage();
        $this->assertEquals($data, $contents);
    }

    public function testGetPackageUsingArrayPackerAndStringArrayValueWithAssociativeArray()
    {
        $values = ['a' => 'A', 'b' => 'B', 'c' => 'C', 'd' => 'D'];
        $name = 'testName';

        $packer = new ArrayPacker();
        $box = new MetaDataBox($packer);

        $item = $this->createMock(MetaItemInterface::class);
        $item->method('getName')->willReturn($name);
        $array = new ArrayMetaValue($values);
        $item->method('getValue')->willReturn($array);

        $box->addItem($item);
        $contents = $box->getPackage();
        $this->assertIsArray($contents);
        $this->assertArrayHasKey($name, $contents);
        $this->assertEquals($values, $contents[$name]);
    }
}
