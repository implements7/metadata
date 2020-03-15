<?php declare(strict_types=1);

namespace MetaData\Items;

use MetaData\MetaItemInterface;
use MetaData\MetaValueInterface;
use MetaData\Values\ArrayMetaValue;

class Hits implements MetaItemInterface
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

    public function hit(string $tag): void
    {
        if (!isset($this->tags[$tag])) {
            $this->tags[$tag] = 0;
        }

        $this->tags[$tag]++;
    }
}