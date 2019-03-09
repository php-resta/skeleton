<?php

namespace Store\Traits;

/**
 * Trait ServiceAnnotationsController
 * @method \Predis\Client redis
 * @method \Store\Services\AppCollection collection
 * @method \Store\Services\Cache cache
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
        $arg[]=$this;

        //in this magic way, the annotations described above are managed by
        //the application static preloader class to be loaded as requested by the application.
        return \application::annotationsLoaders($service,$arg);
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        //in this magic way, the annotations described above are managed by
        //the application static preloader class to be loaded as requested by the application.
        return \application::annotationsLoaders($name,[]);
    }
}