<?php declare(strict_types=1);

namespace MetaData\Packers;

use MetaData\MetaItemInterface;

abstract class ItemListPackerAbstract
{
    protected array $items = [];

    public function packItem(MetaItemInterface $item): void
    {
        $this->items[$item->getName()] = $item->getValue()->get();
    }
}