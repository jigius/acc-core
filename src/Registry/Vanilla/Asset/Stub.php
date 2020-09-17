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
 * Class Stub
 * @package Acc\Core\Pea\Vanilla\Asset
 */
class Stub implements Registry\AssetInterface
{
    /**
     * @inheritDoc
     */
    public function test($val): void
    {
        // nothing to do - this is just a stub
    }
}
