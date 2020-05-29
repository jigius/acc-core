<?php
namespace Acc\Core\Inventory\Asset;

use Acc\Core\Inventory\AssetInterface;
use LogicException;

/**
 * Class IsClass
 * @package Acc\Core\Inventory\Asset
 */
class IsClass implements AssetInterface
{
    /**
     * An object
     * @var object
     */
    private string $object;

    /**
     * An expected classname
     * @var string $test
     */
    private string $test;

    /**
     * A decorated asset
     * @var Vanilla|AssetInterface
     */
    private AssetInterface $orig;

    /**
     * IsClass constructor.
     * @param object $object
     * @param string $name
     * @param AssetInterface|null $asset
     */
    public function __construct(object $object, string $name, ?AssetInterface $asset = null)
    {
        $this->object = $object;
        $this->test = $name;
        $this->orig =
            new isObject(
                $asset ?? new Vanilla()
            );
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
        if (is_a($this->object, $this->test)) {
            throw new FailureException("is not class=`{$this->test}`");
        }
    }
}
