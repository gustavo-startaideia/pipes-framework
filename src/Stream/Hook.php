<?php

namespace Pipes\Stream;

abstract class Hook
{
    /**
     * Indicates actions that run before this hook
     * 
     * @return array
     */
    public function before(): array
    {
        return [];
    }

    /**
     * Indicates actions that run after this hook
     * 
     * @return array
     */
    public function after(): array
    {
        return [];
    }

    /**
     * Handle hook dispatch
     *
     * @param mixed $payload
     * @return mixed
     */
    abstract public function handle(mixed $payload): mixed;
}
