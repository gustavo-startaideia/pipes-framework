<?php

namespace Pipes\Stream\Contracts;

interface HookResolverContract
{
    /**
     * Discovery hooks using a strategy
     * 
     * @return array
     */
    public function resolve(): array;
}
