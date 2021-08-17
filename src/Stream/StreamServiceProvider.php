<?php

namespace Pipes\Stream;

use Pipes\Stream\Contracts\StreamConnectorContract;
use Pipes\Stream\Contracts\StreamContainerContract;
use Pipes\Stream\Contracts\StreamDispatchContract;
use Illuminate\Support\ServiceProvider;
use Pipes\Facades\Stream;

class StreamServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(StreamContainerContract::class, function () {
            return new StreamContainer;
        });

        $this->app->singleton(StreamDispatchContract::class, function () {
            return new StreamDispatcher(
                streamContainer: resolve(StreamContainerContract::class)
            );
        });

        $this->app->singleton(StreamConnectorContract::class, function () {
            return new StreamConnector(
                streamDispatcher: resolve(StreamDispatchContract::class),
                streamContainer: resolve(StreamContainerContract::class)
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Stream::loadHooks();
    }
}
