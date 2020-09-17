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

/**
 * Class Pea
 * @package Acc\Core\Pea\Vanilla
 */
final class Pea implements Registry\BeanInterface
{
    /**
     * An assigned value
     * @var Registry\ValueInterface|null
     */
    private ?Registry\ValueInterface $val;

    /**
     * @var array
     */
    private array $p;

    public function __construct(Registry\ValueInterface $initialValue = null)
    {
        $this->val = $initialValue;
        $this->p = [];
    }

    /**
     * @inheritDoc
     */
    public function value(): Registry\ValueInterface
    {
        $val = $this->val ?? new UndefinedValue();
        array_walk(
            $this->p,
            function (callable $proc, int $idx) use (&$val): void {
                $val = call_user_func($proc, $val, $idx);
            }
        );
        return $val;
    }

    /**
     * @inheritDoc
     */
    public function withValue($v): self
    {
        $obj = $this->blueprinted();
        if (!($v instanceof Registry\DefinedValueInterface)) {
            $v = (new DefinedValue())->assign($v);
        }
        $obj->val = $v;
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function withProcessor(callable $p): self
    {
        $obj = $this->blueprinted();
        $obj->p[] = $p;
        return $obj;
    }

    /**
     * Clones the instance
     * @return self
     */
    private function blueprinted(): self
    {
        $obj = new self($this->val);
        $obj->p = $this->p;
        return $obj;
    }
}
