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
        // this attribute is set in the providers method in the manifest class.
        // this class will show you console errors in a more descriptive and colorful format.
        (new ConsoleExceptionHandler)->register();

    }
}