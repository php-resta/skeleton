<?php

namespace App\Munch\Api\V1\Client\Orders\Orders_create;

trait Orders_createGenerator
{
    /**
     * auto generator for inputs
     * @var array
     */
    protected $generators = ["order_code"];

    /**
     * generators dont overwrite
     *
     * @var array
     */
    protected $generators_dont_overwrite = ["order_code"];

    /**
     * it generates code for request input
     *
     * @return int
     */
    protected function order_codeGenerator()
    {
        return codeGenerator($this,$this->expected);
    }
}