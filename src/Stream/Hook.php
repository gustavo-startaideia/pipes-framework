<?php

namespace Pipes\Stream;

abstract class Hook
{
    /**
     * Indicates actions that run before this hook
     * 
     * @var array
     */
    protected $before = [];

    /**
     * Indicates actions that run after this hook
     * 
     * @var array
     */
    protected $after = [];

    /**
     * Handle hook dispatch
     *
     * @param mixed $payload
     * @return mixed
     */
    abstract public function handle(mixed $payload): mixed;
}
