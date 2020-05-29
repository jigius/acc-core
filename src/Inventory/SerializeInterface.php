<?php
namespace Acc\Core\Inventory;

/**
 * Interface SerializeInterface
 * Defines a contract is used for the serialization of object
 * @package Acc\Core\Inventory
 */
interface SerializeInterface
{
    /**
     * Converts the state of an object into array
     * @return array
     */
    public function serialized(): array;

    /**
     * Creates the new instance of an object with state is reconstructed from passed array
     * @param array $data
     * @return mixed
     */
    public function unserialized(array $data);
}
