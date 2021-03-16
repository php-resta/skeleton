<?php

namespace App\Kernel\Providers;

use Resta\Provider\ServiceProviderManager;

class ExceptionServiceProvider extends ServiceProviderManager
{
    /**
     * register service provider
     *
     * @return void
     */
    public function register()
    {
       $this->app->register('exceptionResponse',function($response,$status){
           //500 Internal Server Error Slash Push Notification
       });
    }
}