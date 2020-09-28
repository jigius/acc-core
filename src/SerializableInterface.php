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

/**
 * Interface SerializableInterface
 * Adds capability to an instance to be serialized to and unserialized from a string
 * @package Acc\Core
 */
interface SerializableInterface
{

    /**
     * Creates an object from its serialized state
     * @param string $input
     * @return mixed
     */
    public function unserialized(string $input);

    /**
     * Creates a serialized object's state in form of a string
     * @return string
     */
    public function serialized(): string;
}
