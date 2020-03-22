<?php declare(strict_types=1);

namespace MetaData\Items;

use MetaData\Items\Traits\ArrayValueTrait;
use MetaData\Items\Traits\NameTrait;
use MetaData\MetaDataBoxItemInterface;

class Hits implements MetaDataBoxItemInterface
{
    use NameTrait;
    use ArrayValueTrait;

    public function __construct(string $name)
    {
        $this->setName($name);
    }

    public function __invoke(string ...$parameters): void
    {
        $this->hit($parameters[0] ?? '');
    }

    public function hit(string $hit): void
    {
        if (!isset($this->values[$hit])) {
            $this->values[$hit] = 0;
        }

        $this->values[$hit]++;
    }
}