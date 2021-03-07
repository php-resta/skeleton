<?php

namespace App\Http;

use Resta\EventDispatcher\EventManager;

class ServiceEventDispatcherManager extends EventManager
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'userRegistered' => [
            'sendMailForUserRegistered',
        ],
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        'checkUserLoginOut'
    ];
}
