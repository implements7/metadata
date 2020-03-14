<?php declare(strict_types=1);

namespace MetaData;

interface MetaProviderInterface
{
    public function getMetaData(): array;
}