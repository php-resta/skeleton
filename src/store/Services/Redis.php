<?php

namespace Store\Services;

use Predis\Client as Client;

class Redis
{
    /**
     * @var array
     */
    private $redisConfig;

    /**
     * Redis constructor.
     * @param array $config
     */
    public function __construct($config = [])
    {
        //redis configuration for app
        if(is_array($config) && count($config)){
            $this->redisConfig = $config;
        }
        else{
            $this->redisConfig = config('redis.redis.default');
        }

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