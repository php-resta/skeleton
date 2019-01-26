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
     * Redis constructor.
     */
    public function __construct()
    {
        //redis configuration for app
        $this->redisConfig=config('redis.redis.default');
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