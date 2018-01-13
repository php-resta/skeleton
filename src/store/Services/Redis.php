<?php

namespace Store\Services;

use Predis\Client as Client;
use Resta\StaticPathModel;
use Resta\Utils;

class Redis {

    /**
     * @var client
     */
    private $client;

    /**
     * redis constructor.
     */
    public function __construct(){

        //redis configuration for app
        $redisConfig=app()->config('redis')->connection;

        //redis client
        $this->client=new Client($redisConfig);
    }

    /**
     * @return Client
     */
    public function client(){

        //redis client object
        return $this->client;
    }

}