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

namespace Acc\Core\Vanilla;

use Acc\Core\ResultInterface;
use Acc\Core\TaskInterface;

/**
 * Class TaskWrap
 * An envelope for composited objects injected into cntr
 * @package Acc\Core\Vanilla
 */
abstract class TaskWrap implements TaskInterface
{
    /**
     * @var TaskInterface|PrinterInterface
     */
    private PrinterInterface $original;

    /**
     * TaskWrap constructor.
     * @param TaskInterface $t
     */
    public function __construct(TaskInterface $t)
    {
        $this->original = $t;
    }

    /**
     * @inheritDoc
     */
    public function executed(): ResultInterface
    {
        return $this->original->executed();
    }

    /**
     * @inheritDoc
     */
    public function unserialized(string $input): TaskInterface
    {
        return $this->original->unserialized($input);
    }

    /**
     * @inheritDoc
     */
    public function serialized(): string
    {
        return $this->original->serialized();
    }
}
