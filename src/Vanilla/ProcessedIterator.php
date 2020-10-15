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

use Acc\Core\MediaInterface;
use Acc\Core\PrinterInterface;
use Iterator, LogicException;

/**
 * Class ProcessedIterator
 * Adds an ability to process data via a defined printer object
 * @package Acc\Core\Vanilla
 */
final class ProcessedIterator implements Iterator
{
    /**
     * @var Iterator
     */
    private Iterator $original;
    /**
     * @var PrinterInterface
     */
    private PrinterInterface $p;

    /**
     * ProcessedIterator constructor.
     * @param Iterator $itr
     * @param PrinterInterface $printer
     */
    public function __construct(Iterator $itr, PrinterInterface $printer)
    {
        $this->original = $itr;
        $this->p = $printer;
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return $this->original->key();
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        $this->original->next();
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->original->rewind();
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return $this->original->valid();
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        $i = $this->original->current();
        if ($i instanceof MediaInterface) {
            $ret = $i->printed($this->p);
        } elseif (is_array($i) || is_object($i)) {
            if (is_object($i)) {
                $i = get_object_vars($i);
            }


            $p = $this->p;
            foreach ($i as $key => $val) {
                $p = $p->with($key, $val);
            }
            $ret = $p->finished();
        } else {
            throw new LogicException("there is no way to pass data into a printer");
        }
        return $ret;
    }
}
