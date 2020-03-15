<?php declare(strict_types=1);

namespace MetaData\Packers;

use MetaData\MetaPackerInterface;

class ArrayPacker extends ItemListPackerAbstract implements MetaPackerInterface
{
    public function getContents()
    {
        return $this->items;
    }
}