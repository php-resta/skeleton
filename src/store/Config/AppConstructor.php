<?php

return [

    'type' => 'default',

    'default' => [
        'constants' => [
            'autoload'      => 'App', //depends on composer.json psr-4 autoload App key
            'project'       => '{project}',
            'prefix'        => 'Api',
            'group'         => '{group}',
            'version'       => 'V1',
            'projectPath'   => ['autoload','project'],
            'versionPath'   => ['autoload','project','prefix','group','version'],
        ],

        'directories'=>[

            'config'        => ['path'=>'versionPath','name'=>'config'],
            'controller'    => ['path'=>'versionPath','name'=>'controller'],
            'middleware'    => ['path'=>'versionPath','name'=>'middleware'],
            'optional'      => ['path'=>'versionPath','name'=>'optional'],
            'model'         => ['path'=>'versionPath','name'=>'model'],
            'migration'     => ['path'=>'versionPath','name'=>'migration'],
            'kernel'        => ['path'=>'projectPath','name'=>'kernel'],
            'repository'    => ['path'=>'projectPath','name'=>'repository'],
            'storage'       => ['path'=>'projectPath','name'=>'storage'],

        ],

        'files' => [
            'serviceAnnotationsController.php'      => ['versionPath'],
            'serviceBaseController.php'             => ['versionPath'],
            'ServiceEventDispatcherController.php'  => ['versionPath'],
            'ServiceLogController.php'              => ['versionPath'],

        ],

        'dependencies' => [

            'directories' => [

                'optional'=>[

                    'request'       => ['name'=>'request'],
                    'source'        => ['name'=>'source'],
                    'webservice'    => ['name'=>'webservice'],
                    'events'        => ['name'=>'events'],
                    'listeners'     => ['name'=>'listeners'],
                    'exception'     => ['name'=>'exception'],
                    'command'       => ['name'=>'command'],
                ],

                'kernel'=>[

                    'node'          => ['name'=>'node'],
                    'providers'     => ['name'=>'providers'],
                    'stub'          => ['name'=>'stub'],
                ]

            ],

            'files' => []
        ],
    ]

];