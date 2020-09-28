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

/**
 * Class Stub
 * @package Acc\Core\Value\Vanilla\Asset
 */
class Stub implements Value\AssetInterface
{
    /**
     * @inheritDoc
     */
    public function test($val): void
    {
        /*
         * No check actually. This is just a stub.
         *
         */
    }
}
