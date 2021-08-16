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
     * @param string $action
     * @return array
     */
    public function getBeforeHooks(string $action): array;

    /**
     * Get the after hooks for the given action
     * 
     * @param string $action
     * @return array
     */
    public function getAfterHooks(string $action): array;

    /**
     * Get all hooks that listen to an action
     * 
     * @param string $action
     * @return array
     */
    public function getHooks(string $action): array;

    /**
     * Check if a hook is already loaded
     * 
     * @return bool
     */
    public function hasHook(string $hook): bool;
}
