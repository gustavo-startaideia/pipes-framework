<?php

namespace Pipes\Facades;

use Illuminate\Support\Facades\Facade;
use Pipes\Stream\Contracts\StreamConnectorContract;

class Stream extends Facade
{
    /**
     * Get stream facade acessor
     * 
     * @return string
     */
    public static function getFacadeAccessor(): string
    {
        return StreamConnectorContract::class;
    }
}
