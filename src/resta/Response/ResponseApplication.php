<?php

namespace Resta\Response;

use Resta\ApplicationProvider;

class ResponseApplication extends ApplicationProvider {

    /**
     * @var array
     */
    public $outputter=[
        'json'=>'Resta\Response\JsonOutputter'
    ];

    /**
     * @method handle
     * @return mixed
     */
    public function handle(){

        //We resolve the response via the service container
        //and run the handle method.
        return $this->makeBind($this->outPutter())->handle();
    }

    /**
     * @method getResponseKind
     * @return mixed
     */
    public function getResponseKind(){

        //we get the response type by checking the instanceController object from the router.
        //Each type of response is in the base class in project directory.
        return ($this->getControllerInstance()===null) ? $this->app->kernel()->responseType :
                $this->getControllerInstance()->response;
    }

    /**
     * @method getControllerInstance
     * @return mixed
     */
    public function getControllerInstance(){

        //we get the instanceController object from the router.
        return $this->app->kernel()->instanceController;
    }

    /**
     * @method outPutter
     * @return mixed
     */
    public function outPutter(){

        //we get and handle the adapter classes in
        //the output array according to the base object.
        return $this->outputter[$this->getResponseKind()];
    }
}