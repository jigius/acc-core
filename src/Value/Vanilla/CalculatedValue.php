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

use Acc\Core\Registry\RegistryInterface;
use Acc\Core\Registry\Vanilla\Registry;
use Acc\Core\Value;
use Acc\Core\Value\CalculatedValueInterface;
use Acc\Core\Value\ValueInterface;
use LogicException;

/**
 * Class CalculatedValue
 * @package Acc\Core\Value\Vanilla
 */
final class CalculatedValue implements CalculatedInterface, Value\ValueInterface, Value\CalculatedValueInterface
{
    /**
     * @var RegistryInterface
     */
    private RegistryInterface $r;

    /**
     * @var callable|null
     */
    private $calculi;
    /**
     * @var RegistryInterface
     */
    private $param;

    /**
     * CalculatedValue constructor.
     *
     * @param RegistryInterface|null $r
     */
    public function __construct(?RegistryInterface $r = null)
    {
        $this->param = $r ?? new Registry();
        $this->calculi = null;
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
    public function withParam(string $name, Value\ValueInterface $val): self
    {
        $obj = $this->blueprinted();
        $obj->param = $this->param->pushed($name, $val);
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function withArg(string $name, $val): self
    {
        $obj = $this->blueprinted();
        $obj->param = $this->param->updated($name, $val);
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function withCalculi(callable $c): self
    {
        $obj = $this->blueprinted();
        $obj->calculi = $c;
        return $obj;
    }

    public function calculated(): Value\ValueInterface
    {
        if ($this->calculi === null) {
            throw new LogicException("a calculi is not defined");
        }
        $val = call_user_func($this->calculi, $this->param);
        if (!($val instanceof Value\ValueInterface)) {
            throw new LogicException("type is invalid");
        }
        return $val;
    }

    /**
     * @inheritDoc
     */
    public function assigned($val): self
    {
        throw new LogicException("is not applicable");
    }

    /**
     * @inheritDoc
     */
    public function defined(): bool
    {
        return $this->calculated()->defined();
    }

    /**
     * @inheritDoc
     */
    public function type(): string
    {
        return $this->calculated()->type();
    }

    /**
     * Clones the instance
     * @return self
     */
    private function blueprinted(): self
    {
        $obj = new self($this->param);
        $obj->calculi = $this->calculi;
        return $obj;
    }
}
