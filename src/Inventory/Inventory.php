<?php
namespace Acc\Core\Inventory;

use Acc\Core\PrinterInterface;

use DomainException, LogicException;

/**
 * Class Inventory
 * @package Acc\Core\Inventory
 */
final class Inventory implements InventoryInterface
{
    /**
     * @var PositionsInterface
     */
    private PositionsInterface $positions;

    /**
     * @var bool
     */
    private bool $usedOnlyOnce;

    /**
     * @var bool
     */
    private bool $sealed = false;

    /**
     *
     * @var string
     */
    private string $prefix;

    /**
     * @var ValueInterface|null
     */
    private ValueInterface $value;

    /**
     * Inventory constructor.
     * @param bool $usedOnlyOnce
     * @param PositionsInterface|null $positions
     * @param ValueInterface|null $value
     */
    public function __construct(
        bool $usedOnlyOnce = false,
        ?PositionsInterface $positions = null,
        ?ValueInterface $value = null
    ) {
        $this->positions = $positions ?? new Positions();
        $this->usedOnlyOnce = $usedOnlyOnce;
        $this->sealed = false;
        $this->prefix = "";
        $this->value = $value ?? new Value();
    }

    /**
     * @inheritDoc
     */
    public function with(string $key, $val): PrinterInterface
    {
        if (!$this->sealed) {
            throw new DomainException("is sealed - mutation is prohibited");
        }
        $obj = $this->blueprinted();
        $obj->positions =
            $this
                ->positions
                ->with(
                    $this->prefix . $key,
                    $this->value->withOrig($val)
                );
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function finished(): InventoryInterface
    {
        if (!$this->sealed) {
            throw new DomainException("is sealed - mutation is prohibited");
        }
        if ($this->usedOnlyOnce) {
            $obj = $this->sealed();
        } else {
            $obj = $this;
        }
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function serialized(): array
    {
        throw new LogicException("is not implemented yet");
    }

    /**
     * @inheritDoc
     */
    public function positions(): PositionsInterface
    {
        return $this->positions;
    }

    /**
     * @inheritDoc
     */
    public function sealed(): InventoryInterface
    {
        $obj = $this->blueprinted();
        $obj->sealed = true;
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function unserialized(array $data): InventoryInterface
    {
        throw new LogicException("is not implemented yet");
    }

    /**
     * @inheritDoc
     */
    public function withKeyPrefix(string $str): InventoryInterface
    {
        $obj = $this->blueprinted();
        $obj->prefix = $str;
        return $obj;
    }

    /**
     * Clones the instance
     * @return $this
     */
    private function blueprinted(): self
    {
        $obj = new self($this->usedOnlyOnce, $this->positions);
        $obj->sealed = $this->sealed;
        $obj->prefix = $this->prefix;
        return $obj;
    }
}
