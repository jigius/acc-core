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
 * Class IsClass
 * @package Acc\Core\Pea\Vanilla\Asset
 */
class IsClass implements Registry\AssetInterface
{
    /**
     * An expected classname
     * @var string $test
     */
    private string $test;

    /**
     * A decorated asset
     * @var Registry\AssetInterface|null
     */
    private ?Registry\AssetInterface $orig;

    /**
     * IsClass constructor.
     * @param string $name
     * @param Registry\AssetInterface|null $asset
     */
    public function __construct(string $name, ?Registry\AssetInterface $asset = null)
    {
        $this->test = $name;
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
        if (is_a($val, $this->test)) {
            throw new FailureException("is not class=`{$this->test}`");
        }
    }
}
