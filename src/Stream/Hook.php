<?php

namespace Pipes\Stream;

abstract class Hook
{
    /**
     * Handle hook dispatch
     *
     * @param mixed $payload
     * @return mixed
     */
    abstract public function handle(mixed $payload): mixed;
}
