<?php declare(strict_types=1);

namespace MetaData;

trait MetaDataTrait
{
    protected array $metaData = [];

    public function getMetaData(): array
    {
        return $this->metaData;
    }
}