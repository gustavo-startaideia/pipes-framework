<?php

namespace Pipes\Stream\Contracts;

use Pipes\Stream\Action;
use Pipes\Stream\Hook;

interface StreamConnectorContract
{
    /**
     * Dispatches an action into the stream
     * 
     * @param Action $action
     * @return mixed
     */
    public function dispatch(Action $action): mixed;

    /**
     * Push a hook into the stream container
     * 
     * @param Hook $hook
     * @return mixed
     */
    public function pushHook(Hook $hook): StreamConnectorContract;
}
