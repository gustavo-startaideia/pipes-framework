<?php

namespace Pipes\Tests\Spies\Stream;

use Pipes\Stream\Contracts\HookRegisterContract;
use Pipes\Tests\Spies\Spy;

class HookRegisterSpy implements HookRegisterContract
{
    use Spy;

    /**
     * Push hook method mock
     * 
     * @param string $hook
     * @return void
     */
    public function pushHook(string $hook): void
    {
        $this->addCall('pushHook', [$hook]);
    }
}
