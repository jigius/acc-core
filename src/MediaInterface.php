<?php
namespace Acc\Core;

/**
 * Interface MediaInterface
 * Adds capability to printing out itsself into passed object with using of `PrinterInterface` contract
 * @package Acc\Core
 */
interface MediaInterface
{
    /**
     * Prints out the current instance to printer object
     * (that is implementing `PrinterInterface` contract)
     * and returns some result from that object
     * @param PrinterInterface $printer
     * @return mixed
     */
    public function printed(PrinterInterface $printer);
}
