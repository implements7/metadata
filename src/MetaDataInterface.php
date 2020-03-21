<?php declare(strict_types=1);

namespace MetaData;

interface MetaDataInterface
{
    public function addItem(MetaItemInterface $item): void;

    public function getItemByName(string $name): MetaItemInterface;

    public function getPackage();
}