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

use Iterator;

/**
 * Interface BeansInterface
 * Defines a contract for objects those are used as Pea by an inventory object
 * @package Acc\Core\Pea
 */
interface BeansInterface
{
    /**
     * Checks if a position with specified key is defined
     * @param string $key
     * @return bool
     */
    public function defined(string $key): bool;

    /**
     * Stores a position with specified key and return a new instance of BeansInterface
     * @param string $key a key
     * @param BeanInterface $p a position
     * @return BeansInterface
     */
    public function pushed(string $key, BeanInterface $p): BeansInterface;

    /**
     * Pulls a position with specified key.
     * @param string $key a requested position
     * @return BeanInterface
     */
    public function pulled(string $key): BeanInterface;

    /**
     * Return defined set of positions as iterable object
     * @return Iterator
     */
    public function iterator(): Iterator;
}
