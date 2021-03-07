<?php

use Store\Services\Cache;
use Store\Services\ExceptionExtender;
use App\Kernel\Providers\AppServiceProvider;
use App\Kernel\Providers\RoleServiceProvider;
use App\Kernel\Providers\CacheServiceProvider;
use App\Kernel\Providers\TrackServiceProvider;
use App\Kernel\Providers\HelperServiceProvider;
use App\Kernel\Providers\WorkerServiceProvider;
use App\Kernel\Providers\EntityServiceProvider;
use App\Kernel\Providers\EloquentServiceProvider;
use App\Kernel\Providers\ResponseServiceProvider;
use App\Kernel\Providers\ExceptionServiceProvider;
use App\Kernel\Providers\ConsoleEventServiceProvider;
use App\Kernel\Providers\AuthenticateServiceProvider;
use App\Kernel\Providers\ConsoleExceptionHandlerServiceProvider;

return [

    /**
     * service providers
     * all providers names
     */
    'providers' => [
        'ConsoleExceptionHandlerServiceProvider'    => ['class' => ConsoleExceptionHandlerServiceProvider::class,'status' => app()->console()],
        'EloquentServiceProvider'                   => ['class' => EloquentServiceProvider::class,'status' => true],
        'AuthenticateServiceProvider'               => ['class' => AuthenticateServiceProvider::class, 'status' => true],
        'HelperServiceProvider'                     => ['class' => HelperServiceProvider::class, 'status' => true],
        'AppServiceProvider'                        => ['class' => AppServiceProvider::class, 'status' => true],
        'ConsoleEventServiceProvider'               => ['class' => ConsoleEventServiceProvider::class, 'status' => app()->runningInConsole()],
        'WorkerServiceProvider'                     => ['class' => WorkerServiceProvider::class, 'status' => true],
        'RoleServiceProvider'                       => ['class' => RoleServiceProvider::class, 'status' => true],
        'CacheServiceProvider'                      => ['class' => CacheServiceProvider::class, 'status' => true],
        'ExceptionServiceProvider'                  => ['class' => ExceptionServiceProvider::class, 'status' => true],
        'TrackServiceProvider'                      => ['class' => TrackServiceProvider::class,'status' => app()->runningInConsole()],
        'EntityServiceProvider'                     => ['class' => EntityServiceProvider::class,'status' => true],
        'ResponseServiceProvider'                   => ['class' => ResponseServiceProvider::class,'status' => true],
    ],

    /**
     * macro classes are user-replaceable classes by the kernel.
     * a list of Macro classes is managed only through the kernel.
     * your own macro classes are outside this feature.
     */
    'macros' => [
        'cache'             => Cache::class,
        'exceptionExtender' => ExceptionExtender::class
    ]
];