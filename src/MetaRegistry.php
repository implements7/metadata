<?php declare(strict_types=1);

namespace MetaData;

use ArrayAccess;
use MetaData\Common\ArrayAccessTrait;
use RuntimeException;

class MetaRegistry implements ArrayAccess
{
    use ArrayAccessTrait;

    private array $registers = [];
    private array $addressNames = [];

    public function register(MetaTrackableInterface $trackable, MetaDataBox $data, ?string $name = ''): void
    {
        $address = $this->getAddress($trackable);
        $this->registers[$address] = $data;

        if (isset($name))
        {
            $this->applyNameToRegistration($address, $name);
        }
    }

    public function getByName(string $name): MetaDataBox
    {
        if (!$this->offsetExists($name))
        {
            throw new RuntimeException("Name not registered");
        }

        return $this[$name];
    }

    public function get(MetaTrackableInterface $trackable): MetaDataBox
    {
        $address = $this->getAddress($trackable);

        return $this->getByAddress($address);
    }

    public function __get(string $name): MetaDataBox
    {
        return $this->getByName($name);
    }

    private function getByAddress(string $address): MetaDataBox
    {
        if (!isset($this->registers[$address])) {
            throw new RuntimeException('Object not registered');
        }

        return $this->registers[$address];
    }

    private function applyNameToRegistration(string $address, string $name): void
    {
        $this->addressNames[$name] = $this->getByAddress($address);

        // For array access.
        $this->setOffsets($this->addressNames);
    }

    private function getAddress(MetaTrackableInterface $trackable): string
    {
        return spl_object_hash($trackable);
    }
}