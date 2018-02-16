<?php

namespace Store\Traits;

/**
 * Trait ServiceAnnotationsController
 * @method \Store\Services\HttpSession session
 * @method \Predis\Client redis
 * @method \Store\Services\AppCollection collection
 * @package App\Mobi\V1
 */
trait Annotations {

    /**
     * @param $service
     * @param $arg
     * @return mixed
     */
    public function __call($service,$arg){

        //in this magic way, the annotations described above are managed by
        //the application static preloader class to be loaded as requested by the application.
        return \application::annotationsLoaders($service,$arg);
    }


}