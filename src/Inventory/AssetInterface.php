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
 * Interface AssetInterface
 * Defines a contract for objects those are used by an inventory object as an asset
 * @package Acc\Core\Inventory
 */
interface AssetInterface extends SerializeInterface
{
    /**
     * Tests an assets
     * @param mixed $val
     */
    public function test($val): void;

    /**
     * @inheritDoc
     * @param array $data
     * @return AssetInterface
     */
    public function unserialized(array $data): AssetInterface;
}