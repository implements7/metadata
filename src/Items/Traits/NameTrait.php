<?php declare(strict_types=1);

namespace MetaData\Items\Traits;

trait NameTrait
{
    protected string $name = '';

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}