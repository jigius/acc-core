<?php
namespace Acc\Core\Inventory;

use Acc\Core\PrinterInterface;

/**
 * Interface InventoryInterface
 * Defines a contract for objects those are used as the inventory of objects
 * @package Acc\Core\Inventory
 */
interface InventoryInterface extends PrinterInterface, SerializeInterface
{
    /**
     * @inheritDoc
     * @param string $key
     * @param mixed $val
     * @return PrinterInterface
     */
    public function with(string $key, $val): PrinterInterface;

    /**
     * @inheritDoc
     * @return InventoryInterface
     */
    public function finished(): InventoryInterface;

    /**
     * Freezes an instance - protects it from aby changing in the future
     * @return InventoryInterface
     */
    public function sealed(): InventoryInterface;

    /**
     * Sets an prefix for keys prefixing with it
     * @param string $str
     * @return InventoryInterface
     */
    public function withKeyPrefix(string $str): InventoryInterface;

    /**
     * Returns all defined with `with()` positions
     * @return PositionsInterface
     */
    public function positions(): PositionsInterface;

    /**
     * @inheritDoc
     * @param array $data
     * @return InventoryInterface
     */
    public function unserialized(array $data): InventoryInterface;
}
