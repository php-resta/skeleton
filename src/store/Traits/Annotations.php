<?php

namespace Store\Traits;

/**
 * Trait ServiceAnnotationsController
 * @method \Predis\Client redis
 * @method \Store\Services\GuzzleHttp http($base=array())
 * @method \Store\Services\AppCollection collection
 * @method \Resta\Cache\CacheManager cache
 * @method \Store\Services\Crypt crypt
 * @method \Store\Services\DateCollection date($locale='en')
 * @method \Store\Services\Queue queue
 */
trait Annotations
{
    /**
     * @param $service
     * @param $arg
     * @return mixed
     */
    public function __call($service,$arg)
    {
        //in this magic way, the annotations described above are managed by
        //the application static preloader class to be loaded as requested by the application.
        return \application::annotationsLoaders($service,$arg,property_exists($this,'reports') ? $this->reports : false);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        //in this magic way, the annotations described above are managed by
        //the application static preloader class to be loaded as requested by the application.
        return \application::annotationsLoaders($name,[],property_exists($this,'reports') ? $this->reports : false);
    }
}