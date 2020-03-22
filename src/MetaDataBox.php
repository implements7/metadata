<?php declare(strict_types=1);

namespace MetaData;

use ArrayAccess;
use MetaData\Common\ArrayAccessTrait;
use RuntimeException;

class MetaDataBox implements MetaDataInterface, MetaDataMagicalInterface, ArrayAccess
{
    use ArrayAccessTrait;

    private array $items = [];
    private MetaPackerInterface $packer;

    public function addItem(MetaItemInterface $item): void
    {
        $this->items[$item->getName()] = $item;

        // For array access.
        $this->setOffsets($this->items);
    }

    public function getPackage(MetaPackerInterface $packer)
    {
        foreach ($this->items as $item) {
            $packer->packItem($item);
        }

        return $packer->getContents();
    }

    public function __get(string $name): MetaDataBoxItemInterface
    {
        return $this->getItemByName($name);
    }

    public function getItemByName(string $name): MetaDataBoxItemInterface
    {
        if (!isset($this->items[$name])) {
            throw new RuntimeException("Item not found");
        }

        return $this->items[$name];
    }

    public function __call(string $name, array $arguments): void
    {
        $this->getItemByName($name)(...$arguments);
    }
}