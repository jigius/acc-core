<?php
namespace Acc\Core;

/**
 * Interface TaskInterface
 * Adds capability to an instance  be executed
 * @package Acc\Core
 */
interface TaskInterface
{
    /**
     * Executes and returns some result
     * @return mixed
     */
    public function executed();
}
