<?php

namespace App\Kernel\Providers;

use Resta\Exception\FileNotFoundException;
use Resta\Provider\ServiceProviderManager;

class HelperServiceProvider extends ServiceProviderManager
{
    /**
     * register service provider
     *
     * @throws FileNotFoundException
     */
    public function register()
    {
       foreach (glob(path()->helpers() . '/*.php') as $file) {
            files()->getRequire($file);
       }
    }
}