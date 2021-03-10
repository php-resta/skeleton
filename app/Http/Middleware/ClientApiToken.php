<?php

namespace App\Http\Middleware;

use Resta\Contracts\HandleContracts;
use Store\Traits\ClientApiTokenTrait;

class ClientApiToken implements HandleContracts
{
    //client token trait
    use ClientApiTokenTrait;

    /**
     * @var string
     */
    protected $tokenFormat = 'header'; //get or header

    /**
     * @var string
     */
    protected $tokenKey = 'apikey';

    /**
     * @var string
     */
    protected $tokenSign = 'ApiKey';

    /**
     * @method clientTokens
     * @define All Client Tokens
     * @return array
     */
    private function clientTokens() : array
    {
        return [
            'testApiClient'=>'api123456'
        ];
    }
}
