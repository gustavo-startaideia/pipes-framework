<?php

namespace Pipes\Stream;

use Pipes\Stream\Contracts\HookRegister;

class Dispatcher
{
    /**
     * Constructor method
     * 
     * @param \Pipes\Stream\Contracts\HookRegister $hookRegister
     */
    public function __construct(
        public HookRegister $hookRegister
    ) {
    }

    /**
     * Inserts an hook into the dispatcher
     * 
     * @param string $hook
     */
    public function pushHook(string $hook)
    {
        $this->hookRegister->pushHook($hook);
    }
}
