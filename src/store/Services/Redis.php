<?php

namespace Store\Services;

use Predis\Client as Client;

class Redis
{
    /**
     * @var \Resta\Config\ConfigProcess
     */
    private $redisConfig;

    /**
     * redis constructor.
     */
    public function __construct()
    {
        //redis configuration for app
        $this->redisConfig=config('redis.connection');
    }

    /**
     * @return Client
     */
    public function client()
    {
        //redis client object
        return new Client($this->redisConfig);
    }

}