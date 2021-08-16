<?php

namespace Pipes\Tests\Spies\Stream;

use Pipes\Tests\Spies\Spy;
use Pipes\Stream\Hook;

class HookSpy extends Hook
{
    use Spy;

    /**
     * Before action register
     * 
     * @var array
     */
    static $before = [
        '<valid_action_name>'
    ];

    /**
     * After action register
     * 
     * @var array
     */
    static $after = [
        '<valid_action_name>'
    ];

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
