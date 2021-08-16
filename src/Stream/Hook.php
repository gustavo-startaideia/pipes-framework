<?php

namespace Pipes\Stream;

abstract class Hook
{
    /**
     * Indicates actions that run before this hook
     * 
     * @return array
     */
    static $before = [];

    /**
     * Indicates actions that run after this hook
     * 
     * @return array
     */
    static $after = [];

    /**
     * Get hook name
     * 
     * @return string
     */
    public function getName(): string
    {
        return get_class($this);
    }

    /**
     * Indicates if the hook should run
     * 
     * @return bool
     */
    public function shouldExecute(): bool
    {
        return true;
    }

    /**
     * Handle hook dispatch
     *
     * @param mixed $payload
     * @return mixed
     */
    abstract public function handle(mixed $payload): mixed;
}
