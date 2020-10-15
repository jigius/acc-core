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

use Acc\Core\MediaInterface;
use Acc\Core\PrinterInterface;

/**
 * Class IterableMedia
 * Makes possible to print out an injected value into a printer
 *
 * @package Acc\Core\Vanilla
 */
final class IterableMedia implements MediaInterface
{
    /**
     * @var array
     */
    private array $i;

    /**
     * IterableMedia constructor.
     * @param iterable $i
     */
    public function __construct(iterable $i)
    {
        $this->i = $i;
    }

    /**
     * @inheritDoc
     */
    public function printed(PrinterInterface $printer)
    {
        foreach ($this->i as $k => $v) {
            $printer = $printer->with($k, $v);
        }
        return $printer->finished();
    }
}
