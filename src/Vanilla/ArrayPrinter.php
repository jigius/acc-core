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
 * Class ArrayPrinter
 * Prints out an media into an array
 *
 * @package Acc\Core\Vanilla
 */
final class ArrayPrinter implements PrinterInterface
{
    /**
     * An initial value
     * @var array
     */
    private array $i;

    /**
     * ArrayPrinter constructor.
     * @param array $i|[]
     */
    public function __construct(array $i = [])
    {
        $this->i = $i;
    }

    /**
     * @inheritDoc
     */
    public function with(string $key, $val): self
    {
        $obj = $this->blueprinted();
        $obj->i[$key] = $val;
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function finished(): array
    {
        return $this->i;
    }

    private function blueprinted(): self
    {
        return new self($this->i);
    }
}
