<?php
namespace Acc\Core\Inventory\Asset;

use Acc\Core\Inventory\AssetInterface;
use LogicException;

/**
 * Class IsEmpty
 * @package Acc\Core\Inventory\Asset
 */
class IsEmpty implements AssetInterface
{
    /**
     * A decorated asset
     * @var Vanilla|AssetInterface
     */
    private AssetInterface $orig;

    /**
     * IsClass constructor.
     * @param AssetInterface|null $asset
     */
    public function __construct(?AssetInterface $asset = null)
    {
        $this->orig = $asset ?? new Vanilla();
    }

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

    /**
     * @inheritDoc
     * @throws FailureException
     */
    public function test($val): void
    {
        $this->orig->test($val);
        if (!empty($val)) {
            throw new FailureException("is not empty");
        }
    }
}
