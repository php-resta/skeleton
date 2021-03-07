<?php

namespace App\Munch\Api\V1;

use App\Munch\Api\V1\Client\Orders\OrdersManager;

/**
 * Class ClientManager
 * @property OrdersManager orders
 * @package App\Mobi\Api\V1
 */
class ClientManager
{ 
    /**
     * @return OrdersManager
     */
    protected function orders()
    {
        return new OrdersManager();
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

        exception('clientManagerError')
            ->badMethodCall('Client manager '.$name.' method is missing');
    }
}
