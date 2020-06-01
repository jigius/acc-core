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
 * Interface MediaInterface
 * Adds capability to printing out itself into passed object with using of `PrinterInterface` contract
 * @package Acc\Core
 */
interface MediaInterface
{
    /**
     * Prints out the current instance to printer object
     * (that is implementing `PrinterInterface` contract)
     * and returns some result from that object
     * @param PrinterInterface $printer
     * @return mixed
     */
    public function printed(PrinterInterface $printer);
}
