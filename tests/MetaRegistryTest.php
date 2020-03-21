<?php declare(strict_types=1);

namespace MetaData;

use PHPUnit\Framework\TestCase;
use RuntimeException;

class MetaRegistryTest extends TestCase
{
    public function testRegister()
    {
        $registry = new MetaRegistry();

        $trackable = $this->createMock(MetaTrackableInterface::class);
        $packer = $this->createMock(MetaPackerInterface::class);
        $box = new MetaDataBox($packer);

        $this->assertNull($registry->register($trackable, $box));
    }

    public function testGet()
    {
        $registry = new MetaRegistry();

        $trackable = $this->createMock(MetaTrackableInterface::class);
        $packer = $this->createMock(MetaPackerInterface::class);
        $box = new MetaDataBox($packer);

        $registry->register($trackable, $box);
        $this->assertSame($box, $registry->get($trackable));
        $this->assertEquals($box, $registry->get($trackable));
        $this->assertSame($registry->get($trackable), $registry->get($trackable));
    }

    public function testGetReturnsSameBoxWhenVariableChangesValue()
    {
        $registry = new MetaRegistry();

        $trackable = new class implements MetaTrackableInterface {
            public array $data = [];
        };

        $packer = $this->createMock(MetaPackerInterface::class);
        $box = new MetaDataBox($packer);

        $registry->register($trackable, $box);
        $this->assertSame($box, $registry->get($trackable));
        $this->assertEquals($box, $registry->get($trackable));
        $this->assertSame($registry->get($trackable), $registry->get($trackable));

        // Modify object, meta is preserved.
        $trackable->data['key'] = 'value';
        $this->assertSame($registry->get($trackable), $registry->get($trackable));
    }

    public function testRegisterWithName()
    {
        $registry = new MetaRegistry();

        $trackable = $this->createMock(MetaTrackableInterface::class);
        $packer = $this->createMock(MetaPackerInterface::class);
        $box = new MetaDataBox($packer);

        $this->assertNull($registry->register($trackable, $box, "testName"));
    }

    public function testGetByName()
    {
        $registry = new MetaRegistry();

        $trackable = $this->createMock(MetaTrackableInterface::class);
        $packer = $this->createMock(MetaPackerInterface::class);
        $box = new MetaDataBox($packer);

        $name = "testName";

        $this->assertNull($registry->register($trackable, $box, $name));
        $this->assertSame($box, $registry->getByName($name));
        $this->assertSame($registry->get($trackable), $registry->getByName($name));
    }

    public function testGetByUnregisteredName()
    {
        $registry = new MetaRegistry();

        $this->expectException(RuntimeException::class);
        $registry->getByName('unregisteredName');
    }

    public function testArrayAccess()
    {
        $registry = new MetaRegistry();

        $trackable = $this->createMock(MetaTrackableInterface::class);
        $packer = $this->createMock(MetaPackerInterface::class);
        $box = new MetaDataBox($packer);

        $this->assertNull($registry->register($trackable, $box, 'testName'));
        $this->assertSame($registry->get($trackable), $registry['testName']);
    }

    public function testArrayAccessUnregisteredName()
    {
        $registry = new MetaRegistry();

        $this->assertArrayNotHasKey('testName', $registry);
    }
}
