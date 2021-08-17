<?php

namespace Pipes;

use Illuminate\Support\ServiceProvider;
use Pipes\Stream\StreamServiceProvider;

class PipesServiceProvider extends ServiceProvider
{
    /**
     * Framework services providers
     * 
     * @var array
     */
    protected $providers = [
        StreamServiceProvider::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/pipes.php',
            'pipes'
        );
        collect($this->providers)->each(fn ($provider) => $this->app->register($provider));
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
