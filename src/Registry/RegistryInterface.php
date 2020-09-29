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

namespace Acc\Core\Registry;

use Acc\Core\Value\ValueInterface;
use Iterator;

/**
 * Interface RegistryInterface
 * Defines a contract for objects that are used as a registry(a collection of values)
 * @package Acc\Core\Registry
 */
interface RegistryInterface
{
    /**
     * Checks if a value with specified key is defined
     * @param string $key
     * @return bool
     */
    public function defined(string $key): bool;

    /**
     * Stores a value with specified key
     * @param string $key a key
     * @param mixed $value a value
     * @return RegistryInterface
     */
    public function pushed(string $key, $value): RegistryInterface;

    /**
     * Pulls a value with specified key.
     * @param string $key a requested position
     * @return ValueInterface
     */
    public function pulled(string $key): ValueInterface;

    /**
     * Return defined set of values as iterable object
     * @return Iterator
     */
    public function iterator(): Iterator;
}
