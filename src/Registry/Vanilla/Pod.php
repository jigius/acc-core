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
use ArrayIterator, Iterator;

/**
 * Class Pea
 * @package Acc\Core\Pea\Vanilla
 */
final class Pod implements Registry\BeansInterface
{
    /**
     * @var array
     */
    private array $data;

    /**
     * Pea constructor.
     */
    public function __construct()
    {
        $this->data = [];
    }

    /**
     * @inheritDoc
     * @return self
     */
    public function pushed(string $key, Registry\BeanInterface $p): self
    {
       $obj = $this->blueprinted();
       $obj->data = $this->data;
       $obj->data[$key] = $p;
       return $obj;
    }

    /**
     * @inheritDoc
     * @return self
     */
    public function pulled(string $key): Registry\BeanInterface
    {
        return $this->data[$key];
    }

    /**
     * @inheritDoc
     */
    public function defined(string $key): bool
    {
        return isset($this->data[$key]);
    }

    /**
     * @inheritDoc
     */
    public function iterator(): Iterator
    {
        return new ArrayIterator($this->data);
    }

    /**
     * Clones the instance
     * @return $this
     */
    private function blueprinted(): self
    {
        $obj = new self();
        $obj->data = $this->data;
        return $obj;
    }
}
