<?php

namespace Pipes\Tests\Spies\Stream;

use Pipes\Stream\Contracts\StreamContainerContract;
use Pipes\Tests\Spies\Spy;
use Pipes\Stream\Action;
use Pipes\Stream\Hook;

class StreamContainerSpy implements StreamContainerContract
{
    use Spy;

    /**
     * Push hook method mock
     * 
     * @param Hook $hook
     * @return void
     */
    public function pushHook(Hook $hook): void
    {
        $this->addCall('pushHook', [$hook]);
    }

    /**
     * getBeforeHooks method mock
     * 
     * @param Action $action
     * @return void
     */
    public function getBeforeHooks(Action $action): array
    {
        return $this->addCall('getBeforeHooks', [$action]);
    }

    /**
     * getAfterHooks method mock
     * 
     * @param Action $action
     * @return void
     */
    public function getAfterHooks(Action $action): array
    {
        return $this->addCall('getAfterHooks', [$action]);
    }

    /**
     * getHooks method mock
     * 
     * @param Action $action
     * @return void
     */
    public function getHooks(Action $action): array
    {
        return $this->addCall('getBeforeHooks', [$action]);
    }

    /**
     * Check if a given hook is registered
     * 
     * @param Hook $hook
     * @return bool
     */
    public function hasHook(Hook $hook): bool
    {
        return $this->addCall('isHookLoaded', [$hook]);
    }
}
