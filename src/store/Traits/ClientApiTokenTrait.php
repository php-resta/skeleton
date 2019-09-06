<?php

namespace Store\Traits;

use DomainException;
use InvalidArgumentException;
use Store\Services\JsonWebToken;

trait ClientApiTokenTrait
{
    /**
     * @method handle
     * @return mixed
     */
    public function handle()
    {
        //identify method name according to token format
        return ($this->tokenFormat==="get") ? $this->getProcess() : $this->headerProcess();
    }

    /**
     * @return mixed|void
     */
    private function getProcess()
    {
        //get token via query param for application
        //check jwt for api key belonging to client
        $getToken = get($this->tokenKey);
        $this->jwtProcess($getToken);
    }

    /**
     * @return mixed|void
     */
    private function headerProcess()
    {
        $clientHeaders = headers();
        $getToken = (isset($clientHeaders[$this->tokenKey])) ? $clientHeaders[$this->tokenKey][0] : null;
        $this->jwtProcess($getToken);
    }

    /**
     * @param $token
     * @return bool|void
     */
    private function jwtProcess($token)
    {
        $checkJwtToken = JsonWebToken::decode($token,$this->tokenSign);
        $webTokenArray = json_decode(json_encode($checkJwtToken),1);

        //check for web token array for api key
        foreach ($webTokenArray as $key=>$value){
            if(array_key_exists($key,$this->clientTokens()) && in_array($value,$this->clientTokens())){
                app()->register('clientApiTokenKey',$key);
                app()->register('illuminator','clientApi',app()->get('clientApiTokenKey'));
                return true;
            }
            throw new DomainException('Client api token is missing');
        }
    }


    /**
     * @param $key
     * @return string
     */
    public function createToken($key)
    {
        //check client token for key
        $tokens = $this->clientTokens();
        $getTokenValue = (isset($tokens[$key])) ? $tokens[$key] : null;

        if($getTokenValue===null) {
            throw new InvalidArgumentException('key is false');
        }

        return JsonWebToken::encode([$key=>$getTokenValue],$this->tokenSign);
    }
}