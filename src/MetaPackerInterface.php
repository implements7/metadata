<?php declare(strict_types=1);

namespace MetaData;

interface MetaPackerInterface
{
    public function packItem(MetaItemInterface $item): void;
    public function getContents();
}