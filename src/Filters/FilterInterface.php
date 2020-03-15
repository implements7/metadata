<?php declare(strict_types=1);

namespace MetaData\Filters;

use MetaData\MetaValueInterface;

interface FilterInterface
{
    public function setValue(MetaValueInterface $value): void;

    public function getFiltered(): MetaValueInterface;
}