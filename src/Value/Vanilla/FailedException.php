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

namespace Acc\Core\Value\Vanilla;

use Acc\Core\PrinterInterface;
use Acc\Core\Value\FailedExceptionInterface;
use DomainException;
use Throwable;

final class FailedException extends DomainException implements FailedExceptionInterface
{
    /**
     * @var mixed|null
     */
    private $value = null;

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function withValue($v): self
    {
        $obj = $this->blueprinted();
        $obj->value = $v;
        return $obj;
    }

    public function printed(PrinterInterface $printer)
    {
        return
            $printer
                ->with('val', $this->value)
                ->finished();
    }

    private function blueprinted(): self
    {
        $obj = new self($this->getMessage(), $this->getCode(), $this->getPrevious());
        $obj->value = $this->value;
        return $obj;
    }
}
