<?php

namespace Pipes\Stream\HookResolvers;

use Pipes\Stream\Contracts\HookResolverContract;

class ConfigFileResolver implements HookResolverContract
{
    /**
     * Resolve hooks from the config file
     * 
     * @return array
     */
    public function resolve(): array
    {
        return config('pipes.hooks.hooks', []);
    }
}
