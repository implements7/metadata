<?php declare(strict_types=1);

namespace MetaData\Packers;

use MetaData\MetaItemInterface;
use MetaData\MetaValueInterface;

abstract class ItemListPackerAbstract
{
    protected array $items = [];

    public function packItem(MetaItemInterface $item): void
    {
        $this->items[$item->getName()] = $this->getAll($item->getValue());
    }

    private function getAll(MetaValueInterface $value)
    {
        $values = $value->get();

        if (is_iterable($values)) {
            $set = [];
            foreach ($values as $key => $value) {
                $set[$key] = $this->recurse($value);
            }
            return $set;
        }

        return $values;
    }

    private function recurse($value) {
        if ($value instanceof MetaValueInterface) {
            return $this->getAll($value);
        }

        return $value;
    }
}