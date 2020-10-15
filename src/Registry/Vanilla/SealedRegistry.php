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
use Acc\Core\Value\ValueInterface;
use Iterator;
use LogicException;

/**
 * Wrap class SealedRegistry
 * The purpose is to prohibit extending an original registry with new values.
 * @property Registry\RegistryInterface original
 * @package Acc\Core\Pea\Vanilla
 */
final class SealedRegistry implements Registry\RegistryInterface
{
    /**
     * SealedRegistry constructor.
     * @param Registry\RegistryInterface $registry
     */
    public function __construct(Registry\RegistryInterface $registry)
    {
        $this->original = $registry;
    }

    /**
     * @inheritDoc
     */
    public function pushed(string $key, $val): Registry\RegistryInterface
    {
        if (!$this->defined($key)) {
            throw new LogicException(
                "the registry has been sealed so additional value with key=`{$key}` has not being included"
            );
        }
        $obj = $this->blueprint();
        $obj->original = $this->original->pushed($key, $val);
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function updated(string $key, $val): Registry\RegistryInterface
    {
        if (!$this->defined($key)) {
            throw new LogicException(
                "the registry has been sealed so additional value with key=`{$key}` has not being included"
            );
        }
        $obj = $this->blueprint();
        $obj->original = $this->original->updated($key, $val);
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function pulled(string $key, $default = null): ValueInterface
    {
        return $this->original->pulled($key, $default);
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
