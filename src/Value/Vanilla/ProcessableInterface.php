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
 * Interface ProcessableInterface
 *
 * @package Acc\Core\Value
 */
interface ProcessableInterface extends ValueInterface
{
    /**
     * Appends a callable, that will be used as a preprocessor of an assigned value in a time of fetching of its
     * @param callable $processor
     * @return ProcessableInterface
     */
    public function withProcessor(callable $processor): ProcessableInterface;
}
