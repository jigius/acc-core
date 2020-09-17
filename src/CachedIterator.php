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

use Iterator;
use OutOfBoundsException;

/**
 * Class CachedIterator
 *
 * Decorates an `Iterator` object that does not support of multiple rewinds.
 *
 * It stores all data (is received from original `Iterator` instance in one pass)
 * into cache and does later multiple rewinds over of it.
 *
 * @package Acc\Core
 */
final class CachedIterator implements Iterator
{
    /**
     * @var Iterator
     */
    private Iterator $orig;

    /**
     * @var array
     */
    private array $cache;

    /**
     * @var int
     */
    private int $maxNum;

    /**
     * @var int
     */
    private int $maxIndex;

    /**
     * @var int
     */
    private int $curIndex;

    /**
     * @var bool
     */
    private bool $detached;

    /**
     * CachedIterator constructor.
     * @param Iterator $itr
     * @param int $maxNum
     */
    public function __construct(Iterator $itr, int $maxNum = 100)
    {
        $this->orig = $itr;
        $this->maxNum = $maxNum;
        $this->cache = [];
        $this->maxIndex = -1;
        $this->curIndex = 0;
        $this->detached = false;
    }

    /**
     * @return mixed|null
     */
    public function current()
    {
        if (!$this->valid()) {
            return null;
        }
        return $this->cache[$this->curIndex][1];

    }

    /**
     * @return bool|float|int|string|null
     */
    public function key()
    {
        if (!$this->valid()) {
            return null;
        }
        return $this->cache[$this->curIndex][0];
    }

    /**
     * @throws OutOfBoundsException
     * @return void
     */
    public function next()
    {
        $ni = $this->curIndex + 1;
        if (!$this->detached) {
            if ($ni > $this->maxIndex) {
                if ($ni === $this->maxNum) {
                    throw new OutOfBoundsException("limit=`{$this->maxNum}` has being exceeded");
                }
                $this->orig->next();
                if ($this->orig->valid()) {
                    $this->cache[$ni] = [
                        $this->orig->key(),
                        $this->orig->current()
                    ];
                    $this->maxIndex = $ni;
                } else {
                    $this->detached = true;
                }
            }
        }
        $this->curIndex = $ni;
    }

    /**
     * @return void
     */
    public function rewind()
    {
        $this->curIndex = 0;
        if (!$this->detached) {
            if ($this->maxIndex === -1) {
                $this->orig->rewind();
                if ($this->orig->valid()) {
                    $this->cache[$this->curIndex] = [
                        $this->orig->key(),
                        $this->orig->current()
                    ];
                    $this->maxIndex = $this->curIndex;
                } else {
                    $this->detached = true;
                }
            }
        }
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return $this->curIndex <= $this->maxIndex;
    }
}
