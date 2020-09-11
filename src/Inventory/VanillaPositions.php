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

namespace Acc\Core\Inventory;

use Acc\Core\PrinterInterface;
use LogicException, ArrayIterator, Iterator;

/**
 * Class VanillaPositions
 * @package Acc\Core\Inventory
 */
class VanillaPositions implements PositionsInterface
{
    /**
     * @var array
     */
    private array $data;

    /**
     * Positions constructor.
     */
    public function __construct()
    {
        $this->data = [];
    }

    /**
     * @inheritDoc
     * @throws LogicException
     */
    public function unserialized(array $data): self
    {
        throw new LogicException("is not implemented yet");
    }

    /**
     * @inheritDoc
     * @throws LogicException
     */
    public function serialized(): array
    {
        throw new LogicException("is not implemented yet");
    }

    /**
     * @inheritDoc
     */
    public function with(string $name, $value): self
    {
        if (!($value instanceof ValueInterface)) {
            $value = (new Value())->withOrig($value);
        }
        $obj = $this->blueprinted();
        $obj->data[$name] = $value;
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function defined(string $name): bool
    {
        return array_key_exists($name, $this->data);
    }

    /**
     * @inheritDoc
     */
    public function fetch(string $name, ?ValueInterface $default = null): ValueInterface
    {
        if (!$this->defined($name)) {
            return $default ?? new Value();
        }
        return $this->data[$name];
    }

    /**
     * @inheritDoc
     */
    public function printed(PrinterInterface $printer)
    {
        foreach ($this->data as $key => $val) {
            $printer = $printer->with($key, $val);
        }
        return $printer;
    }

    /**
     * @inheritDoc
     */
    public function iterator(): Iterator
    {
        return new ArrayIterator($this->data);
    }

    /**
     * Clones the instance
     * @return $this
     */
    private function blueprinted(): self
    {
        $obj = new self();
        $obj->data = $this->data;
        return $obj;
    }
}
