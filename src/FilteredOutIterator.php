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

use Iterator, FilterIterator;

/**
 * Class FilteredOutIterator
 * Adds an ability to filter out elements of an original iterator
 *
 * @package Acc\Core
 */
final class FilteredOutIterator extends FilterIterator
{
    /**
     * @var callable
     */
    private $accept;

    public function __construct(Iterator $iterator, callable $accept)
    {
        parent::__construct($iterator);
        $this->accept = $accept;
    }

    /**
     * @return bool|void
     */
   public function accept(): bool
   {
       return call_user_func($this->accept, $this->current(), $this->key());
   }
}
