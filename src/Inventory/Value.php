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
     * @var ?mixed|null
     */
    private $val = null;

    /**
     * An asset to checks an original value on
     * @var ?AssetInterface
     */
    private ?AssetInterface $asset = null;

    /**
     * An asset to checks an original value on if it's defined
     * @var ?AssetInterface
     */
    private ?AssetInterface $dasset = null;

    /**
     * a processor that will be used for processing of original
     * injected value before returning its to client
     * @var ?callable|null
     */
    private $p = null;

    /**
     * Value constructor.
     */
    public function __construct()
    {
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

    public function withAssetIfDefined(AssetInterface $asset): ValueInterface
    {
        $obj = $this->blueprinted();
        $obj->dasset = $asset;
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


    public function withProcessor(callable $processor): ValueInterface
    {
        $obj = $this->blueprinted();
        $obj->p = $processor;
        return $obj;
    }

    /**
     * @inheritDoc
     */
    public function orig()
    {
        if ($this->asset !== null) {
            $this->asset->test($this->val);
        }
        if ($this->dasset !== null && $this->val !== null) {
            $this->dasset->test($this->val);
        }
        $val = $this->val;
        if ($this->p !== null) {
            $val = call_user_func($this->p, $this->val);
        } else {
            $val = $this->val;
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
        $obj->dasset = $this->dasset;
        $obj->p = $this->p;
        return $obj;
    }
}
