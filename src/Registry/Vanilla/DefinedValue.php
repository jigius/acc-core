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
use LogicException;

/**
 * Class DefinedValue
 * @package Acc\Core\Pea\Vanilla
 */
final class DefinedValue implements Registry\DefinedValueInterface
{
    /**
     * An original value
     * @var mixed|null
     */
    private $val;

    /**
     * assets that are used for testing of a value
     * @var array
     */
    private array $a;

    /**
     * processors that are used for processing of a value
     * @var array
     */
    private array $p;

    /**
     * Value constructor.
     * @param mixed|null $initial An initial value
     */
    public function __construct($initial = null)
    {
        $this->a = [];
        $this->p = [];
        $this->val = $initial;
    }

    /**
     * @inheritDoc
     * @return self
     */
    public function withAsset(Registry\AssetInterface $asset): self
    {
        $obj = $this->blueprinted();
        $obj->a[] = $asset;
        return $obj;
    }

    /**
     * @param mixed $val an assigned value
     * @return self
     */
    public function assign($val): self
    {
        $obj = $this->blueprinted();
        $obj->val = $val;
        return $obj;
    }


    /**
     * @param callable $processor
     * @return self
     */
    public function withProcessor(callable $processor): self
    {
        $obj = $this->blueprinted();
        $obj->p[] = $processor;
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function original()
    {
        return $this->val;
    }

    /**
     * @inheritDoc
     */
    public function fetch()
    {
        $obj = $this;
        array_walk(
            $this->p,
            function ($proc, $idx) use (&$obj) {
                $obj = call_user_func($proc, $obj, $idx);
                if (!($obj instanceof Registry\ValueInterface)) {
                    throw new LogicException("invalid type");
                }
            }
        );
        array_walk(
            $this->a,
            function (Registry\AssetInterface $asset) use ($obj): void {
                $asset->test($obj->original());
            }
        );
        return $obj->original();
    }

    /**
     * @inheritDoc
     */
    public function defined(): bool
    {
        return true;
    }

    /**
     * Clones the instance
     * @return self
     */
    private function blueprinted(): self
    {
        $obj = new self($this->val);
        $obj->a = $this->a;
        $obj->p = $this->p;
        return $obj;
    }
}
