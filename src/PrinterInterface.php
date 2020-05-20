<?php
namespace Acc\Core;

/**
 * Interface PrinterInterface
 * Adds capability to retrieve a data from other objects
 * @package Acc\Core
 */
interface PrinterInterface
{
    /**
     * Feeds an instance with new portion of a data for printing
     * @param $key mixed The key name for passed portion of a data
     * @param $val mixed The value for passed portion of a data
     * @return PrinterInterface
     */
    public function with($key, $val): PrinterInterface;

    /**
     * Produces(outputs) a data as result of "printing" process
     * @return mixed
     */
    public function finished();
}
