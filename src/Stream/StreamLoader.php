<?php

namespace Pipes\Stream;

use Pipes\Stream\Contracts\StreamLoaderContract;

class StreamLoader implements StreamLoaderContract
{
    /**
     * Load all hooks using pre loaded resolvers
     * 
     * @return bool
     */
    public function loadHooks(): bool
    {
        return false;
    }
}
