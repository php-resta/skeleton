<?php

namespace App\Kernel\Providers;

use Resta\Provider\ServiceProviderManager;
use Store\Packages\PushNotification\Slack\Slack;

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
           if(environment()=='production' && $status=='500'){
               //Slack::channel('500')->push(json_encode($response));
           }
       });
    }
}