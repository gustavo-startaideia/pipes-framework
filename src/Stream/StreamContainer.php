<?php

namespace Pipes\Stream;

use Pipes\Stream\Contracts\StreamContainerContract;

class StreamContainer implements StreamContainerContract
{
    protected $hooks = [];

    public function pushHook(string $hook): void
    {
        $this->hooks[] = $hook;
    }

    public function getBeforeHooks(Action $action): array
    {
        return $this->hooks;
    }

    public function getAfterHooks(Action $action): array
    {
        return $this->hooks;
    }

    public function getHooks(Action $action): array
    {
        return $this->hooks;
    }

    /**
     * Check if a given hook is loaded
     * 
     * @param string $hook
     * @return bool
     */
    public function hasHook(string $hook): bool
    {
        return collect($this->hooks)->contains($hook);
    }
}
