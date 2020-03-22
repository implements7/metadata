<?php declare(strict_types=1);

namespace MetaData;

interface MetaItemMagicalInterface
{
    public function __invoke(string ...$parameters): void;
}