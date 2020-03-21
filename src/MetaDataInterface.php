<?php declare(strict_types=1);

namespace MetaData;

interface MetaDataInterface
{
    public function addItem(MetaItemInterface $item): void;

    public function getItemByName(string $name): MetaItemInterface;

    public function getPackage();

    public function __get(string $name): MetaItemInterface;

    public function __call(string $name, array $arguments): void;
}