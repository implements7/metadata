<?php declare(strict_types=1);

namespace MetaData\Packers;

use MetaData\MetaPackerInterface;

class JsonPacker extends ItemListPackerAbstract implements MetaPackerInterface
{
    public function getContents()
    {
        return json_encode($this->items);
    }
}