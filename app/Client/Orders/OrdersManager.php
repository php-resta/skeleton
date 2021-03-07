<?php

namespace App\Munch\Api\V1\Client\Orders;

use App\Munch\Api\V1\Client\Orders\Cancel_update\Cancel_update;

use App\Munch\Api\V1\Client\Orders\Cancel_create\Cancel_create;

use App\Munch\Api\V1\Client\Orders\Orders_update\Orders_update;

use App\Munch\Api\V1\Client\Orders\Orders_create\Orders_create;

use ReflectionException;

/**
 * Class OrdersManager
 * @property Cancel_update cancel_update
 * @property Cancel_create cancel_create
 * @property Orders_update orders_update
 * @property Orders_create orders_create
 * @package App\Munch\Api\V1\Client\Orders
 */
class OrdersManager
{ 
    /**
     * @return Cancel_update
     * 
     * @throws ReflectionException
     */
    protected function cancel_update()
    {
        return new Cancel_update();
    }
             
    /**
     * @return Cancel_create
     * 
     * @throws ReflectionException
     */
    protected function cancel_create()
    {
        return new Cancel_create();
    }
             
    /**
     * @return Orders_update
     * 
     * @throws ReflectionException
     */
    protected function orders_update()
    {
        return new Orders_update();
    }
             
    /**
     * @return Orders_create
     * 
     * @throws ReflectionException
     */
    protected function orders_create()
    {
        return new Orders_create();
    }
            
    /**
    * @param $name
    * @return void|mixed
    */
   public function __get($name)
   {
        if(method_exists($this,$name)){
            return $this->{$name}();
        }

        exception('clientManagerMethodError')
            ->badMethodCall('Register manager '.$name.' method is missing');
   }
}