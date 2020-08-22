<?php

namespace Gateway;

use Store\Services\Redis;
use Predis\Client as Client;

class GatewayManager
{
    /**
     * @var array
     */
    protected $config = [
        '06d44f6b6bba' => [
            'host'          => '172.10.0.6',
            'password'      => null,
            'port'          => 6379,
            'scheme'        => 'tcp',
            'database'      => 0,
        ],
        'ip-172-31-4-101' => [
            'host'          => 'localhost',
            'password'      => null,
            'port'          => 6379,
            'scheme'        => 'tcp',
            'database'      => 0,
        ],
        'ip-172-26-47-155' => [
            'host'          => 'localhost',
            'password'      => null,
            'port'          => 6379,
            'scheme'        => 'tcp',
            'database'      => 0,
        ],

    ];

    /**
     * @var Client
     */
    protected static $redis;

    public function __construct()
    {
       if(is_null(static::$redis)){
           static::$redis = (new Redis($this->config[gethostname()]))->client();
       }
    }


    /**
     * @param callable|null $callback
     * @return mixed|void
     */
    public function handle(callable $callback = null)
    {
        if(is_callable($callback)){
            header('Content-Type: application/json');

            echo '<pre>';
            print_r($_GET);
            echo '</pre>';
            exit();

            if(static::$redis->hexists($_GET['restaurant_code'] ?? 0,$this->hashing())){
               echo static::$redis->hget($_GET['restaurant_code'] ?? 0,$this->hashing());
               exit();
            }

            return call_user_func($callback);
        }
    }

    protected function hashing()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $string = $requestUri.'_'.$this->getHeaders().'_'.isset($_GET['restaurant_code']) ? $_GET['restaurant_code'] : 0;
        return crc32($string);
    }

    /**
     * get headers with crc32 hash
     *
     * @return int
     */
    protected function getHeaders()
    {
        $headers = apache_request_headers();
        $token = $headers['Token'] ?? null;
        $apikey = $headers['Apikey'] ?? null;

        return crc32(serialize(json_encode([
            $apikey,
            $token
        ])));
    }
}