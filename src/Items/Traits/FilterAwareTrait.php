<?php declare(strict_types=1);

namespace MetaData\Items\Traits;

use MetaData\Filters\FilterInterface;

trait FilterAwareTrait
{
    protected array $filters;

    public function addFilter(FilterInterface $filter): void
    {
        $this->filters[] = $filter;
    }

    public function filterValues(): void
    {
        $values = $this->getValue();

        foreach ($this->filters as $filter) {
            $filter->setValue($values);
            $values = $filter->getFiltered();
        }

        $this->clear();
        foreach ($values->get() as $value) {
            $this->append($value->get());
        }
    }
}