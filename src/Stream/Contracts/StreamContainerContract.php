<?php

namespace Pipes\Stream\Contracts;

use Pipes\Stream\Action;
use Pipes\Stream\Hook;

interface StreamContainerContract
{
    /**
     * Register a hook into the stream
     * 
     * @param Hook $hook
     */
    public function pushHook(Hook $hook): void;

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

    /**
     * Check if a hook is already loaded
     * 
     * @param Hook $hook
     * @return bool
     */
    public function hasHook(Hook $hook): bool;
}
