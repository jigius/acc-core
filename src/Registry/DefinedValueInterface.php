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
 * Interface DefinedValueInterface
 * Defines a contract for objects those are used  as a defined values
 * @package Acc\Core\Pea
 */
interface DefinedValueInterface extends ValueInterface
{
    /**
     * Appends an asset that will be used into fetch() method for testing of an original value
     * @param AssetInterface $asset
     * @return DefinedValueInterface
     */
    public function withAsset(AssetInterface $asset): DefinedValueInterface;

    /**
     * Returns an original value has been assigned
     * @return mixed
     */
    public function original();

    /**
     * Returns a value as a result of testing and processing of an original one
     * @return mixed
     */
    public function fetch();

    /**
     * Appends a callable, that will be used into fetch() method for processing of an original value
     * @param callable $processor
     * @return DefinedValueInterface
     */
    public function withProcessor(callable $processor): DefinedValueInterface;

    /**
     * Assigns a value
     * @param mixed $val a value
     * @return DefinedValueInterface
     */
    public function assign($val): DefinedValueInterface;
}
