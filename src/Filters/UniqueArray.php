<?php declare(strict_types=1);

namespace MetaData\Filters;

use MetaData\Values\ArrayMetaValue;

class UniqueArray extends ArrayFilterAbstract implements ArrayFilterInterface
{
    protected function filter(ArrayMetaValue $values): ArrayMetaValue
    {
        $array = [];
        foreach ($values->get() as $value) {
            $array[] = $value->get();
        }

        return new ArrayMetaValue(array_unique($array));
    }
}