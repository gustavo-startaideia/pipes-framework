<?php

namespace Pipes\Stream\Contracts;

interface HookRegisterContract
{
    /**
     * Register a hook into the stream
     * 
     * @param string $hook
     */
    public function pushHook(string $hook): void;
}
