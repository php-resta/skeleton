<?php

namespace Store\Services;

class RequestClient {

    /**
     * @var array $inputs
     */
    protected $inputs=[];

    /**
     * RequestClient constructor.
     */
    public function __construct() {
        $this->handle();
    }

    /**
     * @return void
     */
    private function handle(){

        //get http method
        $method=appInstance()->httpMethod();

        //we record the values ​​
        //that coming with the post.
        $this->initClient($method);

        //we update the input values ​​after we receive and check the saved objects.
        foreach ($this->getClientObjects() as $key=>$value){

            if($method($key)!==null){

                $this->inputs[$key]=$value;

                if($value===null){
                    $this->{$key}=$method($key);
                    $this->inputs[$key]=$this->{$key};
                }

                //if there is method for key
                $requestMethod=$method.''.ucfirst($key);
                if(method_exists($this,$requestMethod)){
                    $this->inputs[$key]=$this->{$requestMethod}();
                }

                if(method_exists($this,$key)){
                    $this->inputs[$key]=$this->{$key}();
                }
            }
        }

        $this->autoInjection();

    }

    /**
     * @return array
     */
    private function getClientObjects(){
        return array_diff_key($this->getObjects(),['inputs'=>[]]);
    }

    /**
     * @return array
     */
    private function getObjects(){
        return get_object_vars($this);
    }

    /**
     * @method initClient
     * @param $method
     * @return void
     */
    private function initClient($method){
        foreach($method() as $key=>$value){
            $this->inputs[$key]=$value;
        }

        $this->autoInjection();
    }

    /**
     * @return array
     */
    protected function get(){
        return $this->inputs;
    }

    /**
     * @return void
     */
    protected function autoInjection(){

        $autoInject=$this->getObjects()['autoInject'];

        if(count($autoInject)){
            foreach($autoInject as $key=>$autoMethod){
                $autoMethod='auto'.ucfirst($autoMethod);
                if(method_exists($this,$autoMethod)){
                    $this->inputs[$key]=$this->{$autoMethod}();
                }

            }
        }

    }

}