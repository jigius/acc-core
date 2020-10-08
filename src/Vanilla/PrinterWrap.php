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
 * Class PrinterWrap
 * An envelope for composited objects injected into cntr
 * @package Acc\Core\Vanilla
 */
abstract class PrinterWrap implements PrinterInterface
{
    private PrinterInterface $original;

    public function __construct(PrinterInterface $p)
    {
        $this->original = $p;
    }

    /**
     * @inheritDoc
     * @return self
     */
    public function with(string $key, $val): self
    {
        return $this->original->with($key, $val);
    }

    /**
     * @inheritDoc
     */
    public function finished()
    {
        return $this->original->finished();
    }
}
