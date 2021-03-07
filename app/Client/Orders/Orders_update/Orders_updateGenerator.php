<?php

namespace App\Munch\Api\V1\Client\Orders\Orders_update;

trait Orders_updateGenerator
{
    /**
     * auto generator for inputs
     * @var array
     */
    protected $generators = [];

    /**
     * generators dont overwrite
     *
     * @var array
     */
    protected $generators_dont_overwrite = [];

    /**
     * it generates code for request input
     *
     * @return int
     */
    protected function codeGenerator()
    {
        return 1;
    }
}