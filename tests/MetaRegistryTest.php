<?php

namespace MetaData;

use PHPUnit\Framework\TestCase;

class MetaRegistryTest extends TestCase
{
    public function testRegister()
    {
        $registry = new MetaRegistry();

        $variable = 'testVariable';
        $packer = $this->createMock(MetaPackerInterface::class);
        $box = new MetaDataBox($packer);

        $this->assertNull($registry->register($variable, $box));
    }

    public function testGet()
    {
        $registry = new MetaRegistry();

        $variable = 'testVariable';
        $packer = $this->createMock(MetaPackerInterface::class);
        $box = new MetaDataBox($packer);

        $registry->register($variable, $box);
        $this->assertNotSame($box, $registry->get($variable));
        $this->assertEquals($box, $registry->get($variable));
    }
}
