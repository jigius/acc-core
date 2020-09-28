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
 * Class Pod
 * @package Acc\Core\Pea\Vanilla
 */
final class Pod implements Registry\BeansInterface
{
    /**
     * @var array
     */
    private array $beans;
    /**
     * @var Registry\BeanInterface|null
     */
    private ?Registry\BeanInterface $bean;

    /**
     * Pea constructor.
     * @param Registry\BeanInterface|null $bean
     */
    public function __construct(?Registry\BeanInterface $bean = null)
    {
        $this->beans = [];
        $this->bean = $bean;
    }

    /**
     * @inheritDoc
     */
    public function created(): Registry\BeanInterface
    {
        return $this->bean ?? new Pea();
    }

    /**
     * @inheritDoc
     * @return self
     */
    public function pushed(string $key, $bean): self
    {
       $obj = $this->blueprinted();
       if (!($bean instanceof Registry\BeanInterface)) {
           $bean = ($this->bean ?? new Pea())->withValue($bean);
       }
       $obj->beans[$key] = $bean;
       return $obj;
    }

    /**
     * @inheritDoc
     * @return self
     */
    public function pulled(string $key): Registry\BeanInterface
    {
        return $this->beans[$key];
    }

    /**
     * @inheritDoc
     */
    public function defined(string $key): bool
    {
        return isset($this->beans[$key]);
    }

    /**
     * @inheritDoc
     */
    public function iterator(): Iterator
    {
        return new ArrayIterator($this->beans);
    }

    /**
     * Clones the instance
     * @return $this
     */
    private function blueprinted(): self
    {
        $obj = new self($this->bean);
        $obj->beans = $this->beans;
        return $obj;
    }
}
