<?php declare(strict_types=1);

namespace MetaData;

use RuntimeException;

class MetaRegistry
{
    private array $registers = [];
    private array $data = [];

    public function register($variable, MetaDataInterface $data): void
    {
        $address = $this->findOrRegister($variable);
        $this->data[$address] = clone $data;
    }

    private function findOrRegister($variable): int
    {
        $key = $this->find($variable);

        if ($key === false) {
            $key = count($this->registers);
            $this->registers[$key] = $variable;
        }

        return $key;
    }

    private function find($variable)
    {
        return array_search($variable, $this->registers);
    }

    public function get($variable): MetaDataInterface
    {
        $key = $this->find($variable);

        if ($key === false) {
            throw new RuntimeException('Variable not registered');
        }

        return $this->data[$key];
    }
}