<?php
namespace Acc\Core\Inventory;

use LogicException;

/**
 * Class Positions
 * @package Acc\Core\Inventory
 */
class Positions implements PositionsInterface
{
    /**
     * @var array
     */
    private array $data;

    /**
     * Positions constructor.
     */
    public function __construct()
    {
        $this->data = [];
    }

    /**
     * @inheritDoc
     * @throws LogicException
     */
    public function unserialized(array $data): PositionsInterface
    {
        throw new LogicException("is not implemented yet");
    }

    /**
     * @inheritDoc
     * @throws LogicException
     */
    public function serialized(): array
    {
        throw new LogicException("is not implemented yet");
    }

    /**
     * @inheritDoc
     */
    public function with(string $name, ValueInterface $value): PositionsInterface
    {
       $obj = $this->blueprinted();
       $obj->data[$name] = $value;
       return $obj;
    }

    /**
     * @inheritDoc
     */
    public function defined(string $name): bool
    {
        return isset($this->data[$name]);
    }

    /**
     * @inheritDoc
     */
    public function fetch(string $name, ?ValueInterface $default = null): ValueInterface
    {
        if (!$this->defined($name)) {
            return $default ?? new Value();
        }
        return $this->data[$name];
    }

    /**
     * Clones the instance
     * @return $this
     */
    private function blueprinted(): self
    {
        $obj = new self();
        $obj->data = $this->data;
        return $obj;
    }
}