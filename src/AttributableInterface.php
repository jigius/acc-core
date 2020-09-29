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

namespace Acc\Core;

use Acc\Core\Registry\RegistryInterface;

/**
 * Interface AttributableInterface
 * Adds the capability of assigning attributes to the object
 * @package Acc\Core
 */
interface AttributableInterface
{
    /**
     * Adds an attribute
     * @param string $name
     * @param mixed $val
     * @return AttributableInterface
     */
    public function withAttr(string $name, $val): AttributableInterface;

    /**
     * Returns all assigned attributes in form of a bunch of beans
     * @return RegistryInterface
     */
    public function attrs(): RegistryInterface;
}
