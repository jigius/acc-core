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

use DomainException, LogicException;

/**
 * Class Inventory
 * Used as an inventory for objects those supports contract `MediaInterface`
 * @package Acc\Core\Inventory
 */
final class Inventory implements InventoryInterface
{
    /**
     * @var PositionsInterface
     */
    private PositionsInterface $positions;

    /**
     * @var bool
     */
    private bool $usedOnlyOnce;

    /**
     * @var bool
     */
    private bool $sealed = false;

    /**
     *
     * @var string
     */
    private string $prefix;

    /**
     * @var ValueInterface|null
     */
    private ValueInterface $value;

    /**
     * Inventory constructor.
     * @param bool $usedOnlyOnce
     * @param PositionsInterface|null $positions
     * @param ValueInterface|null $value
     */
    public function __construct(
        bool $usedOnlyOnce = false,
        ?PositionsInterface $positions = null,
        ?ValueInterface $value = null
    ) {
        $this->positions = $positions ?? new VanillaPositions();
        $this->usedOnlyOnce = $usedOnlyOnce;
        $this->sealed = false;
        $this->prefix = "";
        $this->value = $value ?? new Value();
    }

    /**
     * @inheritDoc
     */
    public function with(string $key, $val): self
    {
        if ($this->sealed) {
            throw new DomainException("is sealed - mutation is prohibited");
        }
        if (!($val instanceof ValueInterface)) {
            $val = $this->value->withOrig($val);
        }
        $obj = $this->blueprinted();
        $obj->positions =
            $this
                ->positions
                ->with(
                    $this->prefix . $key,
                    $val
                );
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function finished(): self
    {
        if ($this->isSealed()) {
            throw new DomainException("is sealed - mutation is prohibited");
        }
        if ($this->usedOnlyOnce) {
            $obj = $this->sealed();
        } else {
            $obj = $this;
        }
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function isSealed(): bool
    {
        return $this->sealed;
    }

    /**
     * @inheritDoc
     */
    public function serialized(): array
    {
        throw new LogicException("is not implemented yet");
    }

    /**
     * @inheritDoc
     */
    public function positions(): PositionsInterface
    {
        return $this->positions;
    }

    /**
     * @inheritDoc
     */
    public function sealed(): self
    {
        $obj = $this->blueprinted();
        $obj->sealed = true;
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function unserialized(array $data): self
    {
        throw new LogicException("is not implemented yet");
    }

    /**
     * @inheritDoc
     */
    public function withKeyPrefix(string $str): self
    {
        $obj = $this->blueprinted();
        $obj->prefix = $str;
        return $obj;
    }

    /**
     * Clones the instance
     * @return $this
     */
    private function blueprinted(): self
    {
        $obj = new self($this->usedOnlyOnce, $this->positions);
        $obj->sealed = $this->sealed;
        $obj->prefix = $this->prefix;
        return $obj;
    }
}
