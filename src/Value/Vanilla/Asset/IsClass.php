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
 * Class IsClass
 * @package Acc\Core\Value\Vanilla\Asset
 */
final class IsClass implements Value\AssetInterface
{
    /**
     * An expected classname
     * @var string $test
     */
    private string $test;

    /**
     * A decorated asset
     * @var Value\AssetInterface|null
     */
    private ?Value\AssetInterface $orig;

    /**
     * IsClass constructor.
     * @param string $name
     * @param Value\AssetInterface|null $asset
     */
    public function __construct(string $name, ?Value\AssetInterface $asset = null)
    {
        $this->test = $name;
        $this->orig = $asset;
    }

    /**
     * @inheritDoc
     * @throws FailedException
     */
    public function test(Value\ValueInterface $val): void
    {
        if ($this->orig !== null) {
            $this->orig->test($val);
        }
        if (!$val->defined()) {
            throw
                (new FailedException("undefined"))
                    ->withValue($val);
        }
        if (is_a($val->fetch(), $this->test)) {
            throw
                (new FailedException("is not class=`{$this->test}`"))
                    ->withValue($val);
        }
    }
}
