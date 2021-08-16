<?php

namespace Pipes\Stream\Contracts;

use Pipes\Stream\Action;

interface StreamContainerContract
{
    /**
     * Register a hook into the stream
     * 
     * @param string $hook
     */
    public function pushHook(string $hook): void;

    /**
     * Get the before hooks for the given action
     * 
     * @param Action $action
     * @return array
     */
    public function getBeforeHooks(Action $action): array;

    /**
     * Get the after hooks for the given action
     * 
     * @param Action $action
     * @return array
     */
    public function getAfterHooks(Action $action): array;

    /**
     * Get all hooks that listen to an action
     * 
     * @param Action $action
     * @return array
     */
    public function getHooks(Action $action): array;
}
