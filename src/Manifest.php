<?php

namespace Src;

use Providers\ConsoleExceptionHandlerServiceProvider;
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

            'EloquentServiceProvider' => EloquentServiceProvider::class,
            'ConsoleExceptionHandlerServiceProvider' => ConsoleExceptionHandlerServiceProvider::class,
        ],

    ];
}