<?php
namespace Acc\Core\Inventory;

/**
 * Interface AssetInterface
 * Defines a contract for objects those are used by an inventory object as an asset
 * @package Acc\Core\Inventory
 */
interface AssetInterface extends SerializeInterface
{
    /**
     * @param mixed $val
     *  Tests an assets
     */
    public function test($val): void;

    /**
     * @inheritDoc
     * @param array $data
     * @return AssetInterface
     */
    public function unserialized(array $data): AssetInterface;
}