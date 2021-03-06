<?php

namespace App\Kernel\Providers;

use Resta\Provider\ServiceProviderManager;

class WorkerServiceProvider extends ServiceProviderManager
{
    /**
     * register service provider
     *
     * @return void
     */
    public function register()
    {
        // worker test
        // is callable method or class namespace
        // php api worker create [project] worker:worker
        $this->app->register('worker','test',function($params){
            return $params;
        });
    }
}