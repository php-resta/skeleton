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
        'host'          => '172.10.0.6',
        'password'      => null,
        'port'          => 6379,
        'scheme'        => 'tcp',
        'database'      => 0,
    ];

    /**
     * @var Client
     */
    protected static $redis;

    public function __construct()
    {
       if(is_null(static::$redis)){
           static::$redis = (new Redis($this->config))->client();
       }
    }


    /**
     * @param callable|null $callback
     * @return mixed|void
     */
    public function handle(callable $callback = null)
    {
        if(is_callable($callback)){
            /**header('Content-Type: application/json');

            $headers = apache_request_headers();
            $token = $headers['Token'] ?? null;
            $apikey = $headers['Apikey'] ?? null;

            echo json_encode([
                'a'             => static::$redis->get('a'),
                'hostname'      => gethostname(),
                'token'         => $token,
                'apikey'        => $apikey,
                'requestUri'    => $_SERVER['REQUEST_URI']
            ]);

            exit();**/

            return call_user_func($callback);
        }
    }
}