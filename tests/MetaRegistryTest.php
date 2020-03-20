<?php declare(strict_types=1);

namespace MetaData;

use PHPUnit\Framework\TestCase;

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
        $this->assertNotSame($box, $registry->get($trackable));
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
        $this->assertNotSame($box, $registry->get($trackable));
        $this->assertEquals($box, $registry->get($trackable));
        $this->assertSame($registry->get($trackable), $registry->get($trackable));

        // Modify object, meta is preserved.
        $trackable->data['key'] = 'value';
        $this->assertSame($registry->get($trackable), $registry->get($trackable));

        // Re-register object to clear meta association.
        $registry->register($trackable, $box);
        $this->assertNotSame($box, $registry->get($trackable));
    }
}
