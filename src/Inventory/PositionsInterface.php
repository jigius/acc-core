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

use Acc\Core\MediaInterface, Iterator;

/**
 * Interface PositionsInterface
 * Defines a contract for objects those are used by an inventory object
 * as a storage of values and binded positions with them
 * @package Acc\Core\Inventory
 */
interface PositionsInterface extends SerializeInterface, MediaInterface
{
    /**
     * Checks if a position has a value
     * @param string $name
     * @return bool
     */
    public function defined(string $name): bool;

    /**
     * Stores a value in a position and return a new instance
     * @param string $name a position
     * @param mixed $value a value
     * @return PositionsInterface
     */
    public function with(string $name, $value): PositionsInterface;

    /**
     * Fetches a value placed into a position is requested.
     * If there is no value into requested position - returns default value.
     * @param string $name a requested position
     * @param ValueInterface|null $default a default value
     * @return ValueInterface
     */
    public function fetch(string $name, ?ValueInterface $default = null): ValueInterface;

    /**
     * Return a set of positions as iterable object
     * @return Iterator
     */
    public function iterator(): Iterator;

    /**
     * @inheritDoc
     * @param array $data
     * @return PositionsInterface
     */
    public function unserialized(array $data): PositionsInterface;
}