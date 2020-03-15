<?php

namespace MetaData\Filters;

interface FilterAwareInterface
{
    public function addFilter(FilterInterface $filter): void;

    public function filterValues(): void;
}