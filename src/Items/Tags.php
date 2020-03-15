<?php declare(strict_types=1);

namespace MetaData\Items;

use MetaData\Filters\FilterAwareInterface;
use MetaData\Items\Traits\ArrayValueTrait;
use MetaData\Items\Traits\FilterAwareTrait;
use MetaData\Items\Traits\NameTrait;
use MetaData\MetaItemInterface;

class Tags implements MetaItemInterface, FilterAwareInterface
{
    use NameTrait;
    use ArrayValueTrait;
    use FilterAwareTrait;

    public function __construct(string $name)
    {
        $this->setName($name);
    }
}