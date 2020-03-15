<?php declare(strict_types=1);

namespace MetaData\Items;

use MetaData\Items\Traits\NameTrait;
use MetaData\MetaItemInterface;
use MetaData\MetaValueInterface;
use MetaData\Values\ArrayMetaValue;

class Tags implements MetaItemInterface
{
    use NameTrait;

    private array $tags = [];

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    public function getValue(): MetaValueInterface
    {
        return new ArrayMetaValue($this->tags);
    }

    public function add(string $tag): void
    {
        $this->tags[] = $tag;
    }
}