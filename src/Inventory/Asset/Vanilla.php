<?php
namespace Acc\Core\Inventory\Asset;

use Acc\Core\Inventory\AssetInterface;
use LogicException;

/**
 * Class Vanilla
 * @package Acc\Core\Inventory\Asset
 */
class Vanilla implements AssetInterface
{
    /**
     * @inheritDoc
     * @throws LogicException
     */
    public function serialized(): array
    {
        throw new LogicException("is not implemented yet");
    }

    /**
     * @inheritDoc
     * @throws LogicException
     */
    public function unserialized(array $data): AssetInterface
    {
        throw new LogicException("is not implemented yet");
    }

    public function test($val): void
    {
        // nothing to do
        return;
    }
}
