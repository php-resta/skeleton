<?php

namespace Src;

use Resta\Foundation\Kernel;
use Providers\EloquentServiceProvider;

class Manifest extends Kernel
{
    /**
     * Changes any kernel group objects.
     *
     * @var array $revision
     */
    protected $revision = [];

    /**
     * this property adds class to the kernel loaders on the user side.
     *
     * @var array $app
     */
    protected $app = [

        /*
        |--------------------------------------------------------------------------
        | Kernel Service providers
        |--------------------------------------------------------------------------
        |
        | The kernel service providers listed here will be automatically loaded on the
        | request to your system. Feel free to add your own services to
        | this array to grant expanded functionality to your applications.
        |
        */
        'providers' => [

            'EloquentServiceProvider' => EloquentServiceProvider::class
        ],

        /*
        |--------------------------------------------------------------------------
        | Application Annotation Register
        |--------------------------------------------------------------------------
        |
        | The annotation service is a magic method that allows you to write easy code.
        | All services you register with this service are included in your application.
        | You will be reminded via your ide the service you use within the application
        | and you will have installed the service.
        |
        */
        'annotations' => [

            'redis'         => ['\Predis\Client'],
            'cache'         => ['\Store\Services\Cache'],
            'collection'    => ['\Store\Services\AppCollection']
        ]

    ];
}