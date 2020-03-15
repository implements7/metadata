<?php declare(strict_types=1);

namespace MetaData;

class MetaDataBox implements MetaDataInterface
{
    private array $items = [];
    private MetaPackerInterface $packer;

    public function __construct(MetaPackerInterface $packer)
    {
        $this->packer = $packer;
    }

    public function addItem(MetaItemInterface $item): void
    {
        $this->items[] = $item;
    }

    public function getPackage()
    {
        foreach ($this->items as $item)
        {
            $this->packer->packItem($item);
        }

        return $this->packer->getContents();
    }
}