<?php

namespace Pipes\Stream;

use Illuminate\Pipeline\Pipeline;
use Pipes\Stream\Contracts\StreamDispatcherContract;
use Pipes\Stream\Contracts\StreamContainerContract;

class StreamDispatcher implements StreamDispatcherContract
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
     * Dispatch an action to the stream
     * 
     * @param string $action
     * @return mixed
     */
    public function dispatch(Action $action): mixed
    {
        $beforeHooks = $this->streamContainer->getBeforeHooks($action);
        $afterHooks  = $this->streamContainer->getAfterHooks($action);

        $payload = app(Pipeline::class)
            ->send($action->getPayload())
            ->through($beforeHooks)
            ->thenReturn();

        $payload = $action->handle($payload);

        $payload = app(Pipeline::class)
            ->send($payload)
            ->through($afterHooks)
            ->thenReturn();

        return $payload;
    }
}
