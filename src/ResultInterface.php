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
 * Interface ResultInterface
 * The contract is used by `Task` contract for expressions of  its result
 * @package Acc\Core
 */
interface ResultInterface extends MediaInterface, PrinterInterface
{
}
