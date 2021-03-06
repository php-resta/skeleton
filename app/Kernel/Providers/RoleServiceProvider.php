<?php

namespace App\Kernel\Providers;

use Resta\Role\RoleManager;
use Resta\Role\RoleInterface;
use Resta\Provider\ServiceProviderManager;

class RoleServiceProvider extends ServiceProviderManager
{
    /**
     * register service provider
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RoleInterface::class,RoleManager::class);
    }
}