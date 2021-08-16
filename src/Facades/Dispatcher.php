<?php

namespace Pipes\Facades;

use Pipes\Stream\Dispatcher as StreamDispatcher;
use Illuminate\Support\Facades\Facade;

class Dispatcher extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return StreamDispatcher::class;
    }
}
