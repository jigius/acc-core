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

namespace Acc\Core\Registry\Vanilla;

use Acc\Core\Registry;
use Acc\Core\Value\ValueInterface;
use LogicException;

/**
 * Wrap class Pea.
 * The purpose is to prohibit the changing the original pea if it has defined value
 * @package Acc\Core\Pea\Vanilla
 */
final class SealedPea implements Registry\BeanInterface
{
    /**
     * An assigned value
     * @var Registry\BeanInterface
     */
    private Registry\BeanInterface $original;

    public function __construct(Registry\BeanInterface $pea)
    {
        $this->original = $pea;
    }

    /**
     * @inheritDoc
     */
    public function value(): ValueInterface
    {
        return $this->original->value();
    }

    /**
     * @inheritDoc
     */
    public function withValue($v): self
    {
        if ($this->value()->defined()) {
            throw
                new LogicException(
                    "The pea has been sealed because its value has already defined"
                );
        }
        $obj = $this->blueprinted();
        $obj->original = $this->original->withValue($v);
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function withProcessor(callable $p): self
    {
        $obj = $this->blueprinted();
        $obj->original = $this->original->withProcessor($p);
        return $obj;
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
