<?php

namespace Src;

use Resta\Foundation\Kernel;

class Manifest extends Kernel
{
    /**
     * Changes any kernel group objects.
     *
     * @var array $revision
     */
    protected $revision = [];

    /**
     * this property changes the kernel life cycle.
     *
     * @var array $app
     */
    protected $app = [

        /*
        |--------------------------------------------------------------------------
        | Kernel Service Providers
        |--------------------------------------------------------------------------
        |
        | The kernel service providers listed here will be automatically loaded on the
        | request to your system. Feel free to add your own services to
        | this array to grant expanded functionality to your applications.
        |
        */
        'providers' => []

    ];
}