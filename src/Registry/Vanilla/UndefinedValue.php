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
 * Class UndefinedValue
 * @property Registry\ValueInterface|null dfdValue
 * @package Acc\Core\Pea\Vanilla
 */
final class UndefinedValue implements Registry\ValueInterface
{
    /**
     * An object is used as blueprint for defined one
     * @var Registry\ValueInterface|null
     */
    private ?Registry\ValueInterface $dfdValue;

    /**
     * UndefinedValue constructor.
     * @param Registry\ValueInterface|null $dfdValue
     */
    public function __construct(Registry\ValueInterface $dfdValue = null)
    {
        $this->dfdValue = $dfdValue;
    }

    /**
     * @inheritDoc
     */
    public function assign($val): Registry\ValueInterface
    {
        return ($this->dfdValue ?? new DefinedValue())->assign($val);
    }

    /**
     * @inheritDoc
     */
    public function defined(): bool
    {
        return false;
    }
}
