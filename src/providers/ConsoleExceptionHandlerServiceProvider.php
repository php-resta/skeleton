<?php

namespace Providers;

use Resta\Provider\ServiceProviderManager;
use NunoMaduro\Collision\Provider as ConsoleExceptionHandler;

class ConsoleExceptionHandlerServiceProvider extends ServiceProviderManager
{
    /**
     * boot service provider
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * register service provider
     *
     * @return void
     */
    public function register()
    {
        // this provider should only be run for the console.
        // the console will show you console errors in a more descriptive and colorful format.
        if($this->app->console()){
            (new ConsoleExceptionHandler)->register();
        }

    }
}