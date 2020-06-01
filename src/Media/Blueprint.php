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

namespace Acc\Core\Media;

use Acc\Core\{PrinterInterface, MediaInterface};
use LogicException;

/**
 * Class Blueprint
 * @package Acc\Core\Media
 */
final class Blueprint implements PrinterInterface, MediaInterface
{
    /**
     * @var array
     */
    private $i;

    /**
     * @var array
     */
    private $c;

    /**
     * Blueprint constructor.
     */
    public function __construct()
    {
        $this->i = [];
    }

    /**
     * @param mixed $key
     * @param mixed $val
     * @return PrinterInterface
     */
    public function with($key, $val): PrinterInterface
    {
        if ($this->c !== null) {
            throw new LogicException("print job is already finished");
        }
        $obj = new self();
        $obj->i = $this->i;
        $obj->i[$key] = $val;
        return $obj;
    }

    /**
     * @return PrinterInterface
     */
    public function finished(): PrinterInterface
    {
        if (empty($this->i)) {
            throw new LogicException("print job has not been run");
        }
        $obj = new self();
        $obj->c = $this->i;
        return $obj;
    }

    /**
     * @param PrinterInterface $p
     * @return mixed
     */
    public function printed(PrinterInterface $p)
    {
        if ($this->c === null) {
            throw new LogicException("print job has not been finish");
        }
        foreach ($this->c as $key => $val) {
            $p = $p->with($key, $val);
        }
        return $p->finished();
    }
}
