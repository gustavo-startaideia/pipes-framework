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
}
