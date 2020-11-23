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

use Acc\Core\Value\ProcessableInterface;
use Acc\Core\Value\ValueInterface;
use LogicException;

/**
 * Wrap class WithProcessor
 * Adds the ability to preprocessing of an original value before its returning (method fetch())
 * @package Acc\Core\Value\Vanilla
 */
final class WithProcessor implements ProcessableInterface
{
    /**
     * An original value
     * @var ValueInterface
     */
    private ValueInterface $original;

    /**
     * Processor that are used for preprocessing of a value
     * @var callable|null
     */
    private $p;

    /**
     * Value constructor.
     * @param ValueInterface $val
     */
    public function __construct(ValueInterface $val)
    {
        $this->original = $val;
        $this->p = null;
    }

    /**
     * @inheritDoc
     */
    public function withProcessor(callable $processor): self
    {
        $obj = $this->blueprinted();
        $obj->p = $processor;
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function original(): ValueInterface
    {
        return $this->original;
    }

    /**
     * @inheritDoc
     */
    public function fetch()
    {
        if ($this->p === null) {
            throw new LogicException("a processor is not defined");
        }
        $val = call_user_func($this->p, $this->original);
        if (!($val instanceof ValueInterface)) {
            throw new LogicException("type is invalid");
        }
        return $val->fetch();
    }

    /**
     * Clones the instance
     * @return self
     */
    private function blueprinted(): self
    {
        $obj = new self($this->original);
        $obj->p = $this->p;
        return $obj;
    }
}
