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
            ->through(collect($beforeHooks)->filter(fn ($hook) => $hook->shouldExecute())->toArray())
            ->thenReturn();

        $payload = $action->handle($payload);

        $payload = app(Pipeline::class)
            ->send($payload)
            ->through(collect($afterHooks)->filter(fn ($hook) => $hook->shouldExecute())->toArray())
            ->thenReturn();

        return $payload;
    }
}
