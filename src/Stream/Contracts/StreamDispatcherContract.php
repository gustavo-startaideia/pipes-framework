<?php

namespace Pipes\Stream\Contracts;

use Pipes\Stream\Action;

interface StreamDispatcherContract
{
    /**
     * Dispatch an action into a stream
     * 
     * @param Action $action
     * @return mixed
     */
    public function dispatch(Action $action): mixed;
}
