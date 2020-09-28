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
 * Interface ConstraintInterface
 * @package Acc\Core\Value
 */
interface ConstraintInterface
{
    /**
     * Appends an asset, that will be used to check a constraint of an assigned value in a time of fetching of its
     * @param AssetInterface $asset
     * @return ConstraintInterface
     */
    public function withAsset(AssetInterface $asset): ConstraintInterface;
}
