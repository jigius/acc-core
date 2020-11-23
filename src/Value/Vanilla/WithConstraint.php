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
use Acc\Core\Value\ConstraintInterface;
use Acc\Core\Value\ValueInterface;

/**
 * Wrap class WithConstraint
 * Adds the ability to check added constraints before returning of an original value (method fetch())
 * @package Acc\Core\Value\Vanilla
 */
final class WithConstraint implements ConstraintInterface, ValueInterface
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
    public function fetch()
    {
        $val = $this->original->fetch();
        $this->a->test($val);
        return $val;
    }

    /**
     * @inheritDoc
     */
    public function original(): ValueInterface
    {
        return $this->original;
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
