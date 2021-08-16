<?php

namespace Pipes\Tests\Spies\Stream;

use Pipes\Stream\Contracts\StreamDispatcherContract;
use Pipes\Tests\Spies\Spy;
use Pipes\Stream\Action;
use Pipes\Stream\Hook;

class StreamDispatcherSpy implements StreamDispatcherContract
{
    use Spy;

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
