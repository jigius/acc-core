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

/**
 * Interface BeanInterface
 * Defines a contract for objects those are used by an positions object as a position
 * @package Acc\Core\Pea
 */
interface BeanInterface
{
    /**
     * Stores a value
     * @param mixed $v a value
     * @return BeanInterface
     */
    public function withValue($v): BeanInterface;

    /**
     * Defines a closure is used as a processor for the value of a position
     * @param callable $p a closure that is get a parameter with `ValueInterface` type
     * @return BeanInterface
     */
    public function withProcessor(callable $p): BeanInterface;

    /**
     * Returns a value
     * @return mixed
     */
    public function value(): ValueInterface;
}