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
 * Interface ValueInterface
 * Defines a contract for objects those are used by an inventory object as a values
 * @package Acc\Core\Inventory
 */
interface ValueInterface
{
    /**
     * Tests an asset with the injected value of an object
     * @param AssetInterface $asset
     * @return ValueInterface
     */
    public function withAsset(AssetInterface $asset): ValueInterface;

    /**
     * Returns an original value was injected.
     * If an asset is defined - it will be checked at the very beginning
     * If processor is defined - it will be used for mutation of original
     * injected value before returned it to client
     * @param callable $processor a processor
     * @return mixed
     */
    public function orig(callable $processor = null);

    /**
     * Injects an original value and return a new instance
     * @param mixed $val an original value
     * @return ValueInterface
     */
    public function withOrig($val): ValueInterface;
}
