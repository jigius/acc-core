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
use Iterator;

/**
 * Abstract class EnvelopePod. The purpose is to simplify the initialization of client's objects
 * @property Registry\BeansInterface original
 * @package Acc\Core\Pea\Vanilla
 */
abstract class EnvelopePod implements Registry\BeansInterface
{
    /**
     * EnvelopePod constructor.
     * @param Registry\BeansInterface $beans
     */
    public function __construct(Registry\BeansInterface $beans)
    {
        $this->original = $beans;
    }

    /**
     * @inheritDoc
     */
    public function pushed(string $key, Registry\BeanInterface $p): Registry\BeansInterface
    {
       return $this->original->pushed($key, $p);
    }

    /**
     * @inheritDoc
     */
    public function pulled(string $key): Registry\BeanInterface
    {
        return $this->original->pulled($key);
    }

    /**
     * @inheritDoc
     */
    public function defined(string $key): bool
    {
        return $this->original->defined($key);
    }

    /**
     * @inheritDoc
     */
    public function iterator(): Iterator
    {
        return $this->original->iterator();
    }
}
