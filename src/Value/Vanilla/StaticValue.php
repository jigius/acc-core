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

use Acc\Core\Value\ValueInterface;
use LogicException;

/**
 * Class Value
 * @package Acc\Core\Value\Vanilla
 */
final class StaticValue implements ValueInterface
{
    /**
     * An original value
     * @var mixed|null
     */
    private $val;
    /**
     * Signs if a value is defined
     * @var bool
     */
    private bool $defined;

    /**
     * Value constructor.
     */
    public function __construct()
    {
        $this->val = null;
        $this->defined = false;
    }

    /**
     * @inheritDoc
     */
    public function assigned($val): self
    {
        $obj = $this->blueprinted();
        $obj->val = $val;
        $obj->defined = true;
        return $obj;
    }

    /**
     * @inheritDoc
     * @throws LogicException Throws an exception if value is undefined
     */
    public function fetch()
    {
        if (!$this->defined()) {
            throw new LogicException("Value is undefined yet", -100);
        }
        return $this->val;
    }

    /**
     * @inheritDoc
     */
    public function type(): string
    {
        if (!$this->defined()) {
            throw new LogicException("Value is undefined yet", -100);
        }
        return gettype($this->val);
    }

    /**
     * @inheritDoc
     */
    public function defined(): bool
    {
        return $this->defined;
    }

    /**
     * Clones the instance
     * @return self
     */
    private function blueprinted(): self
    {
        $obj = new self();
        $obj->val = $this->val;
        $obj->defined = $this->defined;
        return $obj;
    }
}
