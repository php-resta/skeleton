<?php

return [
    'paths' => [
        'storage'           => root,
        'config'            => root,
        'controller'        => root.''.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'Http',
        'middleware'        => root.''.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'Http',
        'route'             => root.''.DIRECTORY_SEPARATOR.'app',
        'exception'         => root.''.DIRECTORY_SEPARATOR.'app',
        'helper'            => root.''.DIRECTORY_SEPARATOR.'app',
        'serviceAnnotation' => root.''.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'Http',
        'repository'        => root.''.DIRECTORY_SEPARATOR.'app',
        'factory'           => root.''.DIRECTORY_SEPARATOR.'app',
        'kernel'            => root.''.DIRECTORY_SEPARATOR.'app',
        'environmentFile'   => root,
        'client'            => root.''.DIRECTORY_SEPARATOR.'app',
        'model'             => root.''.DIRECTORY_SEPARATOR.'app',
    ],
    'namespace' => [
        'controller'                => 'App\Http',
        'middleware'                => 'App\Http',
        'serviceMiddleware'         => 'App\Http',
        'exception'                 => 'App',
        'serviceAnnotation'         => 'App\Http',
        'repository'                => 'App',
        'factory'                   => 'App',
        'kernel'                    => 'App',
        'manifest'                  => 'App\Kernel',
        'eventDispatcherManager'    => 'App\Http',
        'client'                    => 'App',
        'builder'                   => 'App\Model',
        'model'                     => 'App',
    ]

];
