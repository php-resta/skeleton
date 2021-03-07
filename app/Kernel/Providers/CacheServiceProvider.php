<?php

namespace App\Kernel\Providers;

use Resta\Provider\ServiceProviderManager;

class CacheServiceProvider extends ServiceProviderManager
{
    /**
     * register service provider
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('cache','UsersController:index',function($data){
            return (isset($data['data']) && count($data['data'])) ? true : false;
        });
    }
}