<?php

namespace Pipes\Stream;

use Illuminate\Support\ServiceProvider;

class StreamServiceProvider extends ServiceProvider
{
    /**
     * Package singletons
     * 
     * @var array
     */
    protected $singletons = [
        Dispatcher::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        collect($this->singletons)->each(fn ($singleton) => new $singleton);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
