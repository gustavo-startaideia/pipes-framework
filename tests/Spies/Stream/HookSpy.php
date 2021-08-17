<?php

namespace Pipes\Tests\Spies\Stream;

use Pipes\Tests\Spies\Spy;
use Pipes\Stream\Hook;

class HookSpy extends Hook
{
    use Spy;

    /**
     * Handle mock
     * 
     * @return bool
     */
    public function shouldExecute(): bool
    {
        $returnValue = $this->addCall('shouldExecute', []);
        return !is_null($returnValue) ? $returnValue : parent::shouldExecute();
    }

    /**
     * Handle mock
     * 
     * @param mixed $payload
     * @return mixed
     */
    public function handle(mixed $payload): mixed
    {
        return $this->addCall('handle', [$payload]);
    }
}
