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

namespace Acc\Core\Registry\Vanilla\Asset;

use Acc\Core\Registry;

/**
 * Class Custom
 * @package Acc\Core\Pea\Vanilla\Asset
 */
class Custom implements Registry\AssetInterface
{
    /**
     * @var callable
     */
    private $closure;

    /**
     * A decorated asset
     * @var Registry\AssetInterface|null
     */
    private ?Registry\AssetInterface $orig;

    /**
     * IsClass constructor.
     * @param callable $closure
     * @param Registry\AssetInterface|null $asset
     */
    public function __construct(callable $closure, ?Registry\AssetInterface $asset = null)
    {
        $this->closure = $closure;
        $this->orig = $asset;
    }

    /**
     * @inheritDoc
     * @throws FailureException
     */
    public function test($val): void
    {
        if ($this->orig !== null) {
            $this->orig->test($val);
        }
        call_user_func($this->closure, $val);
    }
}
