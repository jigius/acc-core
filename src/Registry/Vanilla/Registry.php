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
use Acc\Core\Value\Vanilla\Value;
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
           $val = ($this->bp ?? new Value())->assign($val);
       }
       $obj->vals[$key] = $val;
       return $obj;
    }

    /**
     * @inheritDoc
     * @return self
     */
    public function pulled(string $key): ValueInterface
    {
        return $this->vals[$key];
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
     * @return $this
     */
    private function blueprinted(): self
    {
        $obj = new self($this->bp);
        $obj->vals = $this->vals;
        return $obj;
    }
}
