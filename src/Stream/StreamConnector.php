<?php

namespace Pipes\Stream;

use Pipes\Stream\Contracts\StreamDispatcherContract;
use Pipes\Stream\Contracts\StreamContainerContract;
use Pipes\Stream\Contracts\StreamConnectorContract;

class StreamConnector implements StreamConnectorContract
{
    /**
     * Constructor method
     * 
     * @param StreamDispatcherContract $dispatcher
     * @param StreamContainerContract $container
     */
    public function __construct(
        public StreamContainerContract $streamContainer,
        public StreamDispatcherContract $streamDispatcher
    ) {
    }

    /**
     * Dispatches an action
     * 
     * @param Action $action
     * @return mixed
     */
    public function dispatch(Action $action): mixed
    {
        return $this->streamDispatcher->dispatch($action);
    }

    /**
     * Insert a hook into the stream
     * 
     * @param Hook $hook
     * @return StreamConnector
     */
    public function pushHook(Hook $hook): StreamConnector
    {
        $this->streamContainer->pushHook($hook);

        return $this;
    }
}
