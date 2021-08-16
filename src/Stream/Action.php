<?php

namespace Pipes\Stream;

abstract class Action
{
    /**
     * Handle action dispatching
     *
     * @param mixed $payload
     * @return mixed
     */
    abstract public function handle(mixed $payload): mixed;

    /**
     * Dispatch this action to all available hooks
     * 
     * @param mixed $payload
     * @return mixed
     */
    static function dispatch(mixed $payload): mixed
    {
    }
}
