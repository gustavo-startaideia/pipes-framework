<?php

namespace Pipes\Stream\Contracts;

interface StreamLoaderContract
{
    /**
     * Load all hooks using the given resolvers
     * 
     * @return bool
     */
    public function loadHooks(): bool;
}
