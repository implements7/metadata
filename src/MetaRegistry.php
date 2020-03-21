<?php declare(strict_types=1);

namespace MetaData;

use MetaData\Common\ArrayAccessTrait;
use RuntimeException;

class MetaRegistry implements \ArrayAccess
{
    use ArrayAccessTrait;

    private array $registers = [];
    private array $addressNames = [];

    public function register(MetaTrackableInterface $trackable, MetaDataInterface $data, ?string $name = ''): void
    {
        $address = $this->getAddress($trackable);
        $this->registers[$address] = $data;

        if (isset($name))
        {
            $this->applyNameToRegistration($address, $name);
        }
    }

    public function getByName(string $name): MetaDataInterface
    {
        if (!$this->offsetExists($name))
        {
            throw new \RuntimeException("Name not registered");
        }

        return $this[$name];
    }

    public function get(MetaTrackableInterface $trackable): MetaDataInterface
    {
        $address = $this->getAddress($trackable);

        return $this->getByAddress($address);
    }

    private function getByAddress(string $address): MetaDataInterface
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