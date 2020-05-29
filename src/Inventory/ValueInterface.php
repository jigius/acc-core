<?php
namespace Acc\Core\Inventory;

/**
 * Interface ValueInterface
 * Defines a contract for objects those are used by an inventory object as a values
 * @package Acc\Core\Inventory
 */
interface ValueInterface
{
    /**
     * Tests an asset with the injected value of an object
     * @param AssetInterface $asset
     * @return ValueInterface
     */
    // fixme!!! what is the last variant????
    public function asset(AssetInterface $asset): ValueInterface;

    /**
     * Returns an original value was injected.
     * If processor is defined - it will be used for mutation of original
     * injected value before returned it to client
     * @param callable $processor a processor
     * @return mixed
     */
    public function orig(callable $processor = null);

    /**
     * Injects an original value and return a new instance
     * @param mixed $val an original value
     * @return ValueInterface
     */
    public function withOrig($val): ValueInterface;
}
