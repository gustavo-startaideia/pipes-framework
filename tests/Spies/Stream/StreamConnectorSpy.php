<?php

namespace Pipes\Tests\Spies\Stream;

use Pipes\Stream\Contracts\StreamConnectorContract;
use Pipes\Tests\Spies\Spy;
use Pipes\Stream\Action;
use Pipes\Stream\Hook;

class StreamConnectorSpy implements StreamConnectorContract
{
    use Spy;

    /**
     * Push hook method mock
     * 
     * @param Hook $hook
     * @return StreamContainerContract
     */
    public function pushHook(Hook $hook): StreamConnectorContract
    {
        $this->addCall('pushHook', [$hook]);

        return $this;
    }

    /**
     * Dispatch a action into the stream
     * 
     * @param Action $action
     */
    public function dispatch(Action $action): mixed
    {
        return $this->addCall('dispatch', [$action]);
    }
}
