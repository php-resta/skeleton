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

        //app redis config
        $redisDb=StaticPathModel::appConfig(true).'\Redis';
        $redisDb=(Utils::makeBind($redisDb))->handle();

        //redis client
        $this->client=new Client($redisDb['connection']);
    }

    /**
     * @return Client
     */
    public function client(){

        //redis client object
        return $this->client;
    }

}