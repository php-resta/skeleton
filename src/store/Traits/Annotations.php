<?php

namespace Store\Traits;

use Resta\Support\Utils;

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
        if(!is_null($resolvedService = $this->isAvailableInStoreServices($service))){
            //in this magic way, the annotations described above are managed by
            //the application static preloader class to be loaded as requested by the application.
            return $resolvedService;
        }
        else{

            //in this magic way, the annotations described above are managed by
            //the application static preloader class to be loaded as requested by the application.
            return \application::annotationsLoaders($service,$arg);
        }

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

    /**
     * check if the service is available in the store/services
     *
     * @param null $service
     * @return mixed|null
     */
    private function isAvailableInStoreServices($service=null)
    {
        $namespace = "Store\\Services\\".ucfirst($service);

        if(Utils::isNamespaceExists($namespace)){
            return app()->resolve($namespace);
        }

        return null;
    }
}