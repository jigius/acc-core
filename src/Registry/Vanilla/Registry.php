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

use Acc\Core\Registry\RegistryInterface;
use Acc\Core\Value\ValueInterface;
use Acc\Core\Value\Vanilla\StaticValue;
use ArrayIterator, Iterator;

/**
 * Class Registry
 * @package Acc\Core\Registry\Vanilla
 */
final class Registry implements RegistryInterface
{
    /**
     * @var array
     */
    private array $vals;
    /**
     * @var ValueInterface|null
     */
    private ?ValueInterface $bp;

    /**
     * Registry constructor.
     * @param ValueInterface|null $blueprint
     */
    public function __construct(?ValueInterface $blueprint = null)
    {
        $this->vals = [];
        $this->bp = $blueprint;
    }

    /**
     * @inheritDoc
     * @return self
     */
    public function pushed(string $key, $val): self
    {
       $obj = $this->blueprinted();
       if (!($val instanceof ValueInterface)) {
           $val = ($this->bp ?? new StaticValue())->assign($val);
       }
       $obj->vals[$key] = $val;
       return $obj;
    }

    /**
     * @inheritDoc
     * @return self
     */
    public function updated(string $key, $val): self
    {
        if (!$this->defined($key)) {
            $obj = $this->pushed($key, $val);
        } else {
            $obj = $this->blueprinted();
            $obj->vals[$key] = $this->pulled($key)->assign($val);
        }
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function pulled(string $key, $default = null): ValueInterface
    {
        if (!$this->defined($key)) {
            if ($default === null) {
                $ret = $this->bp ?? new StaticValue();
            } else {
                if (!($default instanceof ValueInterface)) {
                    $ret = ($this->bp ?? new StaticValue())->assign($default);
                } else {
                    $ret = $default;
                }
            }
        } else {
            $ret = $this->vals[$key];
        }
        return $ret;
    }

    /**
     * @inheritDoc
     */
    public function defined(string $key): bool
    {
        return isset($this->vals[$key]);
    }

    /**
     * @inheritDoc
     */
    public function iterator(): Iterator
    {
        return new ArrayIterator($this->vals);
    }

    /**
     * Clones the instance
     * @return self
     */
    private function blueprinted(): self
    {
        $obj = new self($this->bp);
        $obj->vals = $this->vals;
        return $obj;
    }
}
