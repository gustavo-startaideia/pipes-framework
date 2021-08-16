<?php

namespace Pipes\Tests\Spies\Stream;

use Pipes\Tests\Spies\Spy;
use Pipes\Stream\Action;

class ActionSpy extends Action
{
    use Spy;

    /**
     * Handle mock
     * 
     * @param mixed $payload
     * @return mixed
     */
    public function handle(mixed $payload): mixed
    {
        $this->addCall('handle', [$payload]);
    }
}
