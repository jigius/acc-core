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

namespace Acc\Core\Vanilla;

use Acc\Core\PrinterInterface;

/**
 * Class ConstantPrinter
 * Printing out a vanilla value that has been injected
 * @package Acc\Core\Vanilla
 */
final class ConstantPrinter implements PrinterInterface
{
    /**
     * @var mixed
     */
    private $i;

    /**
     * ConstantPrinter constructor.
     * @param $i
     */
    public function __construct($i)
    {
        $this->i = $i;
    }

    /**
     * @inheritDoc
     */
    public function with(string $key, $val): self
    {
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function finished()
    {
        return $this->i;
    }
}
