<?php

namespace Items\Traits;

use MetaData\Items\Traits\NameTrait;
use PHPUnit\Framework\TestCase;

class NameTraitTest extends TestCase
{
    public function testGetName()
    {
        $name = 'name';
        $nameable = $this->getObjectForTrait(NameTrait::class);
        $nameable->setName($name);
        $this->assertEquals($name, $nameable->getName());
    }
}
