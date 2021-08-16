<?php

namespace Pipes\Stream;

use Pipes\Stream\Contracts\StreamContainerContract;

class Dispatcher
{
    /**
     * Constructor method
     * 
     * @param \Pipes\Stream\Contracts\HookRegister $hookRegister
     */
    public function __construct(
        public StreamContainerContract $streamContainer
    ) {
    }

    /**
     * Inserts an hook into the dispatcher
     * 
     * @param string $hook
     */
    public function pushHook(string $hook)
    {
        $this->streamContainer->pushHook($hook);
    }

    public function dispatchAction(Action $action): mixed
    {
    }
}
