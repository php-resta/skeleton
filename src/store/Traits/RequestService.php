<?php

namespace Store\Traits;

use Store\Services\MobileDetectService;

/**
 * Trait RequestService
 * @method \Store\Services\MobileDetectService device
 */
trait RequestService
{
    /**
     * @var $instance array
     */
    protected static $instance=[];

    /**
     * @var $services array
     */
    protected $services=[
        'device'=>MobileDetectService::class
    ];

    /**
     * @param $service
     * @param $arg
     * @return mixed
     */
    public function __call($service,$arg)
    {
        //We are doing an instance object check for magic method and
        //if this object exists as an instance, this object is called directly.
        if(isset(self::$instance[$service])){
            $instance=self::$instance[$service];
        }

        //If there is no global instance coming in from our magic method,
        //then in this case we register the instance after receiving the service instance.
        if(!isset($instance) && isset($this->services[$service])){
            $serviceName=$this->services[$service];
            self::$instance[$service]=new $serviceName();
            $instance=self::$instance[$service];
        }

        //print instance variable as result
        return (isset($instance)) ? $instance : null;

    }
}