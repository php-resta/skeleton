<?php

namespace App\Client;

/**
 * Class ClientManager
 * @package App\Mobi\Api\V1
 */
class ClientManager
{
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
