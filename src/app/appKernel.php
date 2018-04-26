<?php

namespace App;

use Boot\Encrypter;
use Resta\Booting\ApplicationInstanceLoader;
use Resta\Booting\ConfigLoader;
use Resta\Booting\Environment;
use Resta\Booting\Exception;
use Resta\Booting\GlobalAccessor;
use Resta\Booting\Console;
use Resta\Booting\LogProvider;
use Resta\Booting\Middleware;
use Resta\Booting\ResponseManager;
use Resta\Booting\RouteProvider;
use Resta\Booting\ServiceContainer;
use Resta\Booting\UrlParse;

class appKernel {

    /**
     * @var array
     */
    protected $middlewareGroups=[

        ApplicationInstanceLoader::class,
        GlobalAccessor::class,
        Exception::class,
        UrlParse::class,
        LogProvider::class,
        Environment::class,
        Encrypter::class,
        ConfigLoader::class,
        ServiceContainer::class,
        Middleware::class
    ];

    /**
     * @var array
     */
    protected $bootstrappers=[

        Console::class,
        RouteProvider::class,
        ResponseManager::class,

    ];
}