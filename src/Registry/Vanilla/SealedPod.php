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
use LogicException;

/**
 * Wrap class SealedPod
 * The purpose is to prohibit the including of new peas into original pod.
 * @property Registry\BeansInterface original
 * @package Acc\Core\Pea\Vanilla
 */
final class SealedPod implements Registry\BeansInterface
{
    /**
     * FrozenPod constructor.
     * @param Registry\BeansInterface $pod
     */
    public function __construct(Registry\BeansInterface $pod)
    {
        $this->original = $pod;
    }

    /**
     * @inheritDoc
     */
    public function pushed(string $key, Registry\BeanInterface $bean): Registry\BeansInterface
    {
        if (!$this->defined($key)) {
            throw new LogicException(
                "the pod has been sealed so additional pea with key=`{$key}` has not being included"
            );
        }
        $obj = $this->blueprint();
        $obj->original = $this->original->pushed($key, $bean);
        return $obj;
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
    public function created(): Registry\BeanInterface
    {
        return $this->original->created();
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

    /**
     * Clones the instance
     * @return self
     */
    private function blueprint(): self
    {
        return new self($this->original);
    }
}
