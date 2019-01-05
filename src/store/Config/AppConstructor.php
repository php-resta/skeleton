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
            'versionPath'   => ['autoload','project','prefix','group','version'],
        ],

        'directories'=>[

            'config'        => ['path'=>'versionPath','name'=>'config'],
            'controller'    => ['path'=>'versionPath','name'=>'controller'],
            'middleware'    => ['path'=>'versionPath','name'=>'middleware'],
            'optional'      => ['path'=>'versionPath','name'=>'optional'],
            'model'         => ['path'=>'versionPath','name'=>'model'],
            'migration'     => ['path'=>'versionPath','name'=>'migration'],

        ],

        'files' => [
            'serviceAnnotationsController.php'      => ['versionPath'],
            'serviceBaseController.php'             => ['versionPath'],
            'ServiceEventDispatcherController.php'  => ['versionPath'],
            'ServiceLogController.php'              => ['versionPath'],

        ]
    ]

];