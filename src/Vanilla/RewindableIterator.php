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

use Iterator;
use OutOfBoundsException;

/**
 * Class RewindableIterator
 * Adds an ability to rewind for not rewindable iterators
 * @package Acc\Core\Vanilla
 */
final class RewindableIterator implements Iterator
{
    /**
     * An original notrewindable iterator
     * @var Iterator
     */
    private Iterator $original;
    /**
     * Cached values being gotten from an original iterator
     * @var array
     */
    private array $cached;
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
     * RewindableIterator constructor.
     * @param Iterator $itr
     * @param int $maxNum
     */
    public function __construct(Iterator $itr, int $maxNum = 100)
    {
        $this->original = $itr;
        $this->maxNum = $maxNum;
        $this->cache = [];
        $this->maxIndex = -1;
        $this->curIndex = 0;
        $this->detached = false;
    }

    /**
     * @return mixed
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
                $this->original->next();
                if ($this->original->valid()) {
                    $this->cache[$ni] = [
                        $this->original->key(),
                        $this->original->current()
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
        $o = $this->original;
        $this->curIndex = 0;
        if (!$this->detached) {
            if ($this->maxIndex === -1) {
                $o->rewind();
                if ($o->valid()) {
                    $this->cache[$this->curIndex] = [
                        $o->key(),
                        $o->current()
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
