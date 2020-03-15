<?php declare(strict_types=1);

namespace MetaData\Items;

use MetaData\Items\Traits\ArrayValueTrait;
use MetaData\Items\Traits\NameTrait;
use MetaData\MetaItemInterface;

class Tags implements MetaItemInterface
{
    use NameTrait;
    use ArrayValueTrait;

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    public function add(string $tag): void
    {
        $this->values[] = $tag;
    }
}