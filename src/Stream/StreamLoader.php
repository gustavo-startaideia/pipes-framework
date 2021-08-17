<?php

namespace Pipes\Stream;

use Pipes\Stream\Contracts\StreamContainerContract;
use Pipes\Stream\Contracts\StreamLoaderContract;

class StreamLoader implements StreamLoaderContract
{
    /**
     * Constructor method
     * 
     * @param StreamContainerContract $streamContainer
     */
    public function __construct(
        public StreamContainerContract $streamContainer
    ) {
    }

    /**
     * Load all hooks using pre loaded resolvers
     * 
     * @return bool
     */
    public function loadHooks(): bool
    {
        collect(
            config('pipes.hooks.resolvers')
        )
            ->flatMap(
                fn ($resolver) => is_string($resolver) ? app($resolver)->resolve() : $resolver->resolve()
            )
            ->each(
                fn ($hook) => $this->streamContainer->pushHook($hook)
            );

        return true;
    }
}
