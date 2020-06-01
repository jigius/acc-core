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

namespace Acc\Core\Inventory\Asset;

use Acc\Core\Inventory\AssetInterface;
use LogicException;

/**
 * Class HasContract
 * @package Acc\Core\Inventory\Asset
 */
class HasContract implements AssetInterface
{
    /**
     * An expected classname
     * @var string $test
     */
    private string $test;

    /**
     * A decorated asset
     * @var Stub|AssetInterface
     */
    private AssetInterface $orig;

    /**
     * IsClass constructor.
     * @param string $name
     * @param AssetInterface|null $asset
     */
    public function __construct(string $name, ?AssetInterface $asset = null)
    {
        $this->test = $name;
        $this->orig =
            new IsObject(
                $asset ?? new Stub()
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
        if (!($val instanceof $this->test)) {
            throw new FailureException("the object does not implement contract=`{$this->test}`");
        }
    }
}
