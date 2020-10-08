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

namespace Acc\Core;

/**
 * Interface TaskInterface
 * Adds capability to an instance to be executed in form of a configured task
 * @package Acc\Core
 */
interface TaskInterface extends SerializableInterface
{
    /**
     * @param ResultInterface|null $r
     * @return ResultInterface
     */
    public function executed(?ResultInterface $r = null): ResultInterface;

    /**
     * @inheritDoc
     */
    public function unserialized(string $input): TaskInterface;
}
