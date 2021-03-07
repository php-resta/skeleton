<?php

namespace App\Http;

use Resta\Contracts\ServiceMiddlewareManagerContracts;

class ServiceMiddlewareManager implements ServiceMiddlewareManagerContracts
{
    /**
     * @return array
     */
    public function handle() : array
    {
        return [
              //'loose'=>'all',
              //'clientApiToken'=>'all',
        ];
    }

    /**
     * @return array
     */
    public function after() : array
    {
        return [];
    }

     /**
      * @return array
      */
     public function exclude() : array
     {
        return [
            'all'=>['hook','login','logout']
         ];
     }
}
