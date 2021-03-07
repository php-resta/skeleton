<?php

namespace App\Munch\Api\V1\Client;

trait ClientGenerator
{
    /**
     * auto generator for inputs
     * @var array
     */
    protected $auto_generators = [];

    /**
     * auto generators dont overwrite
     *
     * @var array
     */
    protected $auto_generators_dont_overwrite = [];

    //
}