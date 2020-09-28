<?php
declare(strict_types=1);

namespace Acc\Core\Value;

use Acc\Core\MediaInterface;

interface FailedExceptionInterface extends MediaInterface
{
    /**
     * Stores a value that is a subject of an exception
     * @param ValueInterface $v A value
     * @return FailedExceptionInterface
     */
    public function withValue(ValueInterface $v): FailedExceptionInterface;
}
