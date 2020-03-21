<?php declare(strict_types=1);

namespace MetaData;

interface MetaDataMagicalInterface
{
    public function __get(string $name): MetaItemInterface;

    public function __call(string $name, array $arguments): void;
}