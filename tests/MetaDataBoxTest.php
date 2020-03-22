<?php declare(strict_types=1);

use MetaData\MetaDataBox;
use MetaData\MetaDataBoxItemInterface;
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
        $box = new MetaDataBox();

        $item = $this->createMock(MetaDataBoxItemInterface::class);
        $this->assertNull($box->addItem($item));
    }

    public function testGetItemByName()
    {
        $box = new MetaDataBox();

        $name = 'testName';

        $item = $this->createMock(MetaDataBoxItemInterface::class);
        $item->method('getName')->willReturn($name);

        $box->addItem($item);
        $this->assertSame($item, $box->getItemByName($name));
    }

    public function testGetMissingItemByName()
    {
        $box = new MetaDataBox();

        $name = 'testName';

        $this->expectException(RuntimeException::class);
        $box->getItemByName($name);
    }

    public function testGetItemByArrayAccess()
    {
        $box = new MetaDataBox();

        $name = 'testName';

        $item = $this->createMock(MetaDataBoxItemInterface::class);
        $item->method('getName')->willReturn($name);

        $box->addItem($item);
        $this->assertSame($item, $box[$name]);
        $this->assertSame($box->getItemByName($name), $box[$name]);
    }

    public function testGetItemByObjectAccess()
    {
        $box = new MetaDataBox();

        $name = 'testName';

        $item = $this->createMock(MetaDataBoxItemInterface::class);
        $item->method('getName')->willReturn($name);

        $box->addItem($item);
        $this->assertSame($item, $box->$name);
        $this->assertSame($box->getItemByName($name), $box->$name);
    }

    public function testInvokeForMissingItem()
    {
        $box = new MetaDataBox();

        $this->expectException(RuntimeException::class);
        $box->doThings();
    }

    public function testInvokeForItem()
    {
        $box = new MetaDataBox();

        $name = 'testName';
        $item = $this->createMock(MetaDataBoxItemInterface::class);
        $item->method('getName')->willReturn($name);
        $box->addItem($item);

        $this->assertNull($box->$name());
    }

    public function testGetMissingItemByArrayAccess()
    {
        $packer = new ArrayPacker();
        $box = new MetaDataBox($packer);

        $name = 'testName';
        $this->assertArrayNotHasKey($name, $box);
    }

    public function testGetPackage()
    {
        $box = new MetaDataBox();

        $packer = $this->createMock(MetaPackerInterface::class);
        $packer->method('getContents')->willReturn([]);


        $this->assertIsArray($box->getPackage($packer));
    }

    public function testGetPackageUsingArrayPackerAndStringValue()
    {
        $box = new MetaDataBox();

        $value = 'testString';
        $name = 'testName';

        $item = $this->createMock(MetaDataBoxItemInterface::class);
        $item->method('getName')->willReturn($name);
        $string = new StringMetaValue($value);
        $item->method('getValue')->willReturn($string);

        $box->addItem($item);

        $packer = new ArrayPacker();
        $contents = $box->getPackage($packer);

        $this->assertIsArray($contents);
        $this->assertArrayHasKey($name, $contents);
        $this->assertEquals($value, $contents[$name]);
    }

    public function testGetPackageUsingArrayPackerAndStringArrayValue()
    {
        $box = new MetaDataBox();

        $values = ['a', 'b', 'c', 'd'];
        $name = 'testName';

        $item = $this->createMock(MetaDataBoxItemInterface::class);
        $item->method('getName')->willReturn($name);
        $array = new ArrayMetaValue($values);
        $item->method('getValue')->willReturn($array);

        $box->addItem($item);

        $packer = new ArrayPacker();
        $contents = $box->getPackage($packer);

        $this->assertIsArray($contents);
        $this->assertArrayHasKey($name, $contents);
        $this->assertEquals($values, $contents[$name]);
    }

    public function testGetPackageUsingArrayPackerAndMultipleStringArrayValues()
    {
        $box = new MetaDataBox();

        $data = [
            'one' => ['a', 'b', 'c', 'd'],
            'two' => ['a', 'b', 'c', 'd']
        ];

        foreach ($data as $name => $values) {
            $item = $this->createMock(MetaDataBoxItemInterface::class);
            $item->method('getName')->willReturn($name);
            $array = new ArrayMetaValue($values);
            $item->method('getValue')->willReturn($array);
            $box->addItem($item);
        }

        $packer = new ArrayPacker();
        $contents = $box->getPackage($packer);
        $this->assertEquals($data, $contents);
    }

    public function testGetPackageUsingArrayPackerAndStringArrayValueWithAssociativeArray()
    {
        $box = new MetaDataBox();

        $values = ['a' => 'A', 'b' => 'B', 'c' => 'C', 'd' => 'D'];
        $name = 'testName';

        $item = $this->createMock(MetaDataBoxItemInterface::class);
        $item->method('getName')->willReturn($name);
        $array = new ArrayMetaValue($values);
        $item->method('getValue')->willReturn($array);

        $box->addItem($item);

        $packer = new ArrayPacker();
        $contents = $box->getPackage($packer);

        $this->assertIsArray($contents);
        $this->assertArrayHasKey($name, $contents);
        $this->assertEquals($values, $contents[$name]);
    }
}
