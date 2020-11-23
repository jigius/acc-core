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

use Acc\Core\Value\ValueInterface;
use LogicException;

/**
 * Wrap class SealedValue
 * Makes impossible to redefine an already defined original static value
 * @package Acc\Core\Value\Vanilla
 */
final class SealedValue implements ValueInterface
{
    /**
     * An original value
     * @var ValueInterface
     */
    private $original;

    /**
     * SealedValue constructor.
     * @param ValueInterface $v
     */
    public function __construct(ValueInterface $v)
    {
        $this->original = $v;
    }

    /**
     * @inheritDoc
     */
    public function assign($val): self
    {
        if ($this->original->defined()) {
            throw
                new LogicException(
                    "The value has been sealed because its value has already defined"
                );
        }
        $obj = $this->blueprinted();
        $obj->original = $this->original->assign($val);
        return $obj;
    }

    /**
     * @inheritDoc
     * @throws LogicException Throws an exception if value is undefined
     */
    public function fetch()
    {
        return $this->original->fetch();
    }

    /**
     * @inheritDoc
     */
    public function defined(): bool
    {
        return $this->original->defined();
    }

    /**
     * @inheritDoc
     */
    public function type(): string
    {
        return $this->original->type();
    }

    /**
     * Clones the instance
     * @return self
     */
    private function blueprinted(): self
    {
        return new self($this->original);
    }
}
