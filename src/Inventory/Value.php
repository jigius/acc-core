<?php
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
    private $val = null;

    /**
     * Value constructor.
     */
    public function __construct()
    {
    }

    /**
     * @inheritDoc
     */
    public function asset(AssetInterface $asset): ValueInterface
    {
        $asset->test($this->val);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function withOrig($val): ValueInterface
    {
       $obj = new self();
       $obj->val = $val;
       return $obj;
    }

    /**
     * @inheritDoc
     */
    public function orig(callable $processor = null)
    {
        if ($processor !== null) {
            $ret = call_user_func($processor);
        } else {
            $ret = $this->val;
        }
        return $ret;
    }
}
