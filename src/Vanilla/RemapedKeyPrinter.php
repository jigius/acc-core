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
 * Class RemapedKeyPrinter
 * Remaps keys of values for an original printer
 *
 * @package Acc\Core\Vanilla
 */
final class RemapedKeyPrinter implements PrinterInterface
{
    /**
     * @var PrinterInterface
     */
    private PrinterInterface $original;
    /**
     * @var array
     */
    private array $m;

    /**
     * RemapedKeyPrinter constructor.
     * @param PrinterInterface $p
     * @param array $map
     */
    public function __construct(PrinterInterface $p, array $map)
    {
        $this->original = $p;
        $this->m = $map;
    }

    /**
     * @inheritDoc
     */
    public function with(string $key, $val): PrinterInterface
    {
        if (isset($this->m[$key])) {
            $key = $this->m[$key];
        }
        $obj = $this->blueprinted();
        $obj->original = $this->original->with($key, $val);
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function finished()
    {
        return $this->original->finished();
    }

    private function blueprinted(): self
    {
        return new self($this->original, $this->m);
    }
}
