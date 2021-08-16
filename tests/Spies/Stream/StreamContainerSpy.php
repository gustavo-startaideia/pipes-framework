<?php

namespace Pipes\Tests\Spies\Stream;

use Pipes\Stream\Contracts\StreamContainerContract;
use Pipes\Tests\Spies\Spy;

class StreamContainerSpy implements StreamContainerContract
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

    /**
     * getBeforeHooks method mock
     * 
     * @param string $action
     * @return void
     */
    public function getBeforeHooks(string $action): array
    {
        $this->addCall('pushHook', [$action]);

        return [];
    }

    /**
     * getAfterHooks method mock
     * 
     * @param string $action
     * @return void
     */
    public function getAfterHooks(string $action): array
    {
        $this->addCall('getAfterHooks', [$action]);

        return [];
    }

    /**
     * getHooks method mock
     * 
     * @param string $action
     * @return void
     */
    public function getHooks(string $action): array
    {
        $this->addCall('getBeforeHooks', [$action]);

        return [];
    }

    /**
     * Check if a given hook is registered
     * 
     * @param string $hook
     * @return bool
     */
    public function hasHook(string $hook): bool
    {
        $this->addCall('isHookLoaded', [$hook]);
        return true;
    }
}
