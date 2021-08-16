<?php

namespace Pipes\Stream\Contracts;

interface HookRegister
{
    /**
     * Register a hook into the stream
     * 
     * @param string $hook
     */
    public function pushHook(string $hook): void;
}
