<?php declare(strict_types=1);

namespace MetaData\Items;

use MetaData\MetaItemInterface;
use MetaData\MetaValueInterface;
use MetaData\Values\ArrayMetaValue;

class Tags implements MetaItemInterface
{
    private string $name = '';
    private array $tags = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
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