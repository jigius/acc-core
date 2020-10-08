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
 * Class FilteredPrinter
 * Filters out passed values with an injected callable
 * @package Acc\Core\Vanilla
 */
final class FilteredPrinter implements PrinterInterface
{
    /**
     * @var PrinterInterface
     */
    private PrinterInterface $original;

    /**
     * @var callable
     */
    private $accept;

    /**
     * FilteredPrinter constructor.
     * @param PrinterInterface $p
     * @param callable $accept
     */
    public function __construct(PrinterInterface $p, callable $accept)
    {
        $this->original = $p;
        $this->accept = $accept;
    }

    /**
     * @inheritDoc
     */
    public function with(string $key, $val): PrinterInterface
    {
        if (call_user_func($this->accept, $val, $key)) {
            $obj = $this->blueprinted();
            $obj->original = $this->original->with($key, $val);
        } else {
            $obj = $this;
        }
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function finished()
    {
        return $this->original->finished();
    }

    /**
     * Clones the instance
     * @return $this
     */
    private function blueprinted(): self
    {
        return new self($this->original, $this->accept);
    }
}
