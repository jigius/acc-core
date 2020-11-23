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

namespace Acc\Core\Value\Vanilla;

use Acc\Core\Value\ValueInterface;

/**
 * Interface ValueInterface
 * Defines a base contract for Value objects
 * @package Acc\Core\Value\Vanilla
 */
interface CalculatedInterface
{
    /**
     * Defines a param
     * @param string $name a name
     * @param ValueInterface $val a value
     * @return CalculatedInterface
     */
    public function withParam(string $name, ValueInterface $val): CalculatedInterface;

    /**
     * Defines an argument for a named param
     *
     * @param string $name a param's name
     * @param mixed $val a value
     * @return CalculatedInterface
     */
    public function withArg(string $name, $val): CalculatedInterface;

    /**
     * Defimes an anonymous function that do a calculation of a value
     * @param callable $c
     * @return CalculatedInterface
     */
    public function withCalculi(callable $c): CalculatedInterface;
}
