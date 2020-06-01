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

/**
 * Interface SerializeInterface
 * Defines a contract is used for the serialization of object
 * @package Acc\Core\Inventory
 */
interface SerializeInterface
{
    /**
     * Converts the state of an object into array
     * @return array
     */
    public function serialized(): array;

    /**
     * Creates the new instance of an object with state is reconstructed from passed array
     * @param array $data
     * @return mixed
     */
    public function unserialized(array $data);
}
