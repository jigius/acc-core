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
use Throwable;

/**
 * Class Custom
 * @package Acc\Core\Value\Vanilla\Asset
 */
final class Custom implements Value\AssetInterface
{
    /**
     * @var callable
     */
    private $closure;

    /**
     * A decorated asset
     * @var Value\AssetInterface|null
     */
    private ?Value\AssetInterface $orig;

    /**
     * IsClass constructor.
     * @param callable $closure
     * @param Value\AssetInterface|null $asset
     */
    public function __construct(callable $closure, ?Value\AssetInterface $asset = null)
    {
        $this->closure = $closure;
        $this->orig = $asset;
    }

    /**
     * @inheritDoc
     * @throws FailedException|Throwable
     */
    public function test(Value\ValueInterface $val): void
    {
        if ($this->orig !== null) {
            $this->orig->test($val);
        }
        call_user_func($this->closure, $val);
    }
}
