<?php

namespace Pipes\Stream\Contracts;

use Pipes\Stream\Action;
use Pipes\Stream\Hook;

interface StreamConnectorContract
{
    public function dispatch(Action $action): mixed;

    public function pushHook(Hook $hook): StreamConnectorContract;
}
