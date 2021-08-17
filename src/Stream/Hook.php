<?php

namespace Pipes\Stream;

class Hook
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
    public static function getName(): string
    {
        return static::class;
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
    public function handle(mixed $payload): mixed
    {
        return $payload;
    }
}
