<?php

namespace App\Munch\Api\V1\Client\Orders\Cancel_create;

trait Cancel_createGenerator
{
    /**
     * auto generator for inputs
     * @var array
     */
    protected $generators = ["order_cancel_code"];

    /**
     * generators dont overwrite
     *
     * @var array
     */
    protected $generators_dont_overwrite = ["order_cancel_code"];

    /**
     * it generates code for request input
     *
     * @return int
     */
    protected function order_cancel_codeGenerator()
    {
        return codeGenerator($this,$this->expected);
    }
}