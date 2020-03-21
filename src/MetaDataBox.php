<?php declare(strict_types=1);

namespace MetaData;

use ArrayAccess;
use MetaData\Common\ArrayAccessTrait;
use RuntimeException;

class MetaDataBox implements MetaDataInterface, ArrayAccess
{
    use ArrayAccessTrait;

    private array $items = [];
    private MetaPackerInterface $packer;

    public function __construct(MetaPackerInterface $packer)
    {
        $this->packer = $packer;
    }

    public function addItem(MetaItemInterface $item): void
    {
        $this->items[$item->getName()] = $item;

        // For array access.
        $this->setOffsets($this->items);
    }

    public function getItemByName(string $name): MetaItemInterface
    {
        if (!isset($this->items[$name])) {
            throw new RuntimeException("Item not found");
        }

        return $this->items[$name];
    }

    public function getPackage()
    {
        foreach ($this->items as $item) {
            $this->packer->packItem($item);
        }

        return $this->packer->getContents();
    }

    public function __get(string $name): MetaItemInterface
    {
        return $this->getItemByName($name);
    }

    public function __call(string $name, array $arguments): void
    {
        $this->getItemByName($name)(...$arguments);
    }
}