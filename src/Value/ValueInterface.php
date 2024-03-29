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

namespace Acc\Core\Value;

/**
 * Interface ValueInterface
 * Defines a base contract for Value objects
 * @package Acc\Core\Value
 */
interface ValueInterface
{
    /**
     * Returns passed value
     *
     * @return mixed
     */
    public function fetch();

    /**
     * Assigns a value
     * @param mixed $val a value
     * @return ValueInterface
     */
    public function assigned($val): ValueInterface;

    /**
     * Checks if the instance has defined value or not
     * @return bool
     */
    public function defined(): bool;

    /**
     * Returns a type of defined value
     * @return string
     */
    public function type(): string;
}
