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

namespace Acc\Core\Value\Vanilla\Asset;

use Acc\Core\Value;
use Acc\Core\Value\Vanilla\FailedException;

/**
 * Class IsNotMandatory
 * @package Acc\Core\Value\Vanilla\Asset
 */
final class IsNotMandatory implements Value\AssetInterface
{
    /**
     * A decorated asset
     * @var Value\AssetInterface
     */
    private Value\AssetInterface $original;

    /**
     * IsNotMandatory constructor.
     * @param Value\AssetInterface $asset
     */
    public function __construct(Value\AssetInterface $asset)
    {
        $this->orig = $asset;
    }

    /**
     * @inheritDoc
     * @throws FailedException
     */
    public function test(Value\ValueInterface $val): void
    {
        if (!$val->defined()) {
            return;
        }
        $this->orig->test($val);
    }
}
