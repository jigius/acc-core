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

namespace Acc\Core\Inventory;

/**
 * Class Value
 * @package Acc\Core\Inventory
 */
class Value implements ValueInterface
{
    /**
     * An original value
     * @var mixed|null
     */
    private $val;

    /**
     * A defined asset to checks an original value on
     * @var Asset\Stub|AssetInterface
     */
    private AssetInterface $asset;

    /**
     * Value constructor.
     */
    public function __construct()
    {
        $this->val = null;
        $this->asset = new Asset\Stub();
    }

    /**
     * @inheritDoc
     */
    public function withAsset(AssetInterface $asset): ValueInterface
    {
        $obj = $this->blueprinted();
        $obj->asset = $asset;
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function withOrig($val): ValueInterface
    {
        $obj = $this->blueprinted();
        $obj->val = $val;
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function orig(callable $processor = null)
    {
        $val = $this->val;
        $this->asset->test($val);
        if ($processor !== null) {
            $val = call_user_func($processor, $val);
        }
        return $val;
    }

    /**
     * Clones the instance
     * @return $this
     */
    private function blueprinted(): self
    {
        $obj = new self();
        $obj->val = $this->val;
        $obj->asset = $this->asset;
        return $obj;
    }
}
