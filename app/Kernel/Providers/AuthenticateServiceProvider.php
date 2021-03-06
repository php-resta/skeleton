<?php

namespace App\Kernel\Providers;

use Resta\Provider\ServiceProviderManager;

class AuthenticateServiceProvider extends ServiceProviderManager
{
    /**
     * register service provider
     *
     * @return void
     */
    public function register()
    {
        /**$this->app->register('authenticate','token',function($auth){
            return $auth->id;
        });**/

        $this->app->register('authenticate','password',function($password){
           return md5(sha1($password)); // or verify
        });

        $this->app->register('authenticate','addQuery',function($query){
            $query->where('status',1);
        });

        $this->app->register('authenticate','client',function(){
            //authenticate client
        });

        /**
         * The process you can do after the authenticate query. You should definitely return boolean to callback.
         */
        $this->app->register('authenticate','after',function(){
            return true;
        });

        //You can change your configuration settings for authenticate.
        $this->app->register('authenticate','configuration',function($config){
            return $config;
        });
    }
}