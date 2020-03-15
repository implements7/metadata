<?php declare(strict_types=1);

namespace MetaData\Filters;

use MetaData\Values\ArrayMetaValue;

interface ArrayFilterInterface extends FilterInterface
{
    public function getFiltered(): ArrayMetaValue;
}