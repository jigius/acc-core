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

namespace Acc\Core\Value\Vanilla;

use Acc\Core\Value\AssetInterface;
use Acc\Core\Value\CalculatedValueInterface;
use Acc\Core\Value\ChainedValueInterface;
use Acc\Core\Value\ValueInterface;

/**
 * Wrap class WithConstraint
 * Adds the ability to check added constraints before returning of an original value (method fetch())
 * @package Acc\Core\Value\Vanilla
 */
final class WithConstraint implements ConstraintInterface, CalculatedValueInterface, ChainedValueInterface
{
    /**
     * An original value
     * @var ValueInterface
     */
    private ValueInterface $original;

    /**
     * asset that are used for testing of a value
     * @var AssetInterface|null
     */
    private ?AssetInterface $a;

    /**
     * Value constructor.
     * @param ValueInterface $val
     */
    public function __construct(ValueInterface $val)
    {
        $this->original = $val;
        $this->a = null;
    }

    /**
     * @inheritDoc
     */
    public function withAsset(AssetInterface $asset): self
    {
        $obj = $this->blueprinted();
        $obj->a = $asset;
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function assigned($val): self
    {
        $obj = $this->blueprinted();
        $obj->original = $this->original->assigned($val);
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function fetch()
    {
        return $this->calculated()->fetch();
    }

    /**
     * @inheritDoc
     */
    public function type(): string
    {
        return $this->calculated()->type();
    }

    /**
     * @return bool
     */
    public function defined(): bool
    {
        return $this->calculated()->defined();
    }

    /**
     * @inheritDoc
     */
    public function calculated(): ValueInterface
    {
        $this->a->test($this->original);
        return $this->original;
    }

    /**
     *
     * @inheritDoc
     */
    public function original(): ValueInterface
    {
        $original = $this->original;
        if ($original instanceof ChainedValueInterface) {
            $original = $original->original();
        }
        return $original;
    }

    /**
     * Clones the instance
     * @return self
     */
    private function blueprinted(): self
    {
        $obj = new self($this->original);
        $obj->a = $this->a;
        return $obj;
    }
}
