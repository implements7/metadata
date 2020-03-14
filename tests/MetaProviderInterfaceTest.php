<?php

use MetaData\MetaDataTrait;
use MetaData\MetaProviderInterface;
use PHPUnit\Framework\TestCase;

require_once dirname(__DIR__) . '/vendor/autoload.php';

final class MetaProviderInterfaceTest extends TestCase
{
    public function testCanGetMetaData()
    {
        $mock = $this->createMock(MetaProviderInterface::class);
        $this->assertIsArray($mock->getMetaData());
    }
}