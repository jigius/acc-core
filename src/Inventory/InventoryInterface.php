<?php
/**
 * This file is part of the jigius/acc-core library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) 2020 Jigius <jigius@gmail.com>
 * @link https://github.com/jigius/acc-core GitHub
 */

declare(strict_types=1);

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
     * @return InventoryInterface
     */
    public function with(string $key, $val): InventoryInterface;

    /**
     * @inheritDoc
     * @return InventoryInterface
     */
    public function finished(): InventoryInterface;

    /**
     * Checks if the inventory is sealed
     * @return bool
     */
    public function isSealed(): bool;

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
