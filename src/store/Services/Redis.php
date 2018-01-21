<?php

namespace Store\Services;

use Predis\Client as Client;
use Resta\StaticPathModel;
use Resta\Utils;

class Redis {

    /**
     * @var
     */
    private $redisConfig;

    /**
     * redis constructor.
     */
    public function __construct(){

        //redis configuration for app
        $this->redisConfig=app()->config('redis')->connection;
    }

    /**
     * @return Client
     */
    public function client(){

        //redis client object
        return new Client($this->redisConfig);
    }

}