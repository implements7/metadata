<?php declare(strict_types=1);

namespace MetaData;

interface MetaItemInterface
{
    public function getName(): string;

    public function getValue(): MetaValueInterface;
}