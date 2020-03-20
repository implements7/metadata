<?php declare(strict_types=1);

namespace MetaData;

use RuntimeException;

class MetaRegistry
{
    private array $registers = [];

    public function register(MetaTrackableInterface $trackable, MetaDataInterface $data): void
    {
        $address = $this->getAddress($trackable);
        $this->registers[$address] = clone $data;
    }

    private function getAddress(MetaTrackableInterface $trackable): string
    {
        return spl_object_hash($trackable);
    }

    public function get($trackable): MetaDataInterface
    {
        $address = $this->getAddress($trackable);

        if (!isset($this->registers[$address])) {
            throw new RuntimeException('Object not registered');
        }

        return $this->registers[$address];
    }
}