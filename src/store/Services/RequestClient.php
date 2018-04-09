<?php

namespace Store\Services;

class RequestClient{

    /**
     * @var array $inputs
     */
    private $inputs=[];

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

        //we record the values ​​
        //that coming with the post.
        $this->initClient();

        //we update the input values ​​after we receive and check the saved objects.
        foreach ($this->getClientObjects() as $key=>$value){

            if(get($key)!==null){

                $this->inputs[$key]=$value;

                if($value===null){
                    $this->{$key}=get($key);
                    $this->inputs[$key]=$this->{$key};
                }

                //if there is method for key
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
     * @return void
     */
    private function initClient(){
        foreach(get() as $key=>$value){
            $this->inputs[$key]=$value;
        }
    }

    /**
     * @return array
     */
    public function get(){
        return $this->inputs;
    }

    /**
     * @return void
     */
    public function autoInjection(){

        $autoInject=$this->getObjects()['autoInject'];

        if(count($autoInject)){
            foreach($autoInject as $autoMethod){
                if(method_exists($this,$autoMethod)){
                    $this->inputs[$autoMethod]=$this->{$autoMethod}();
                }

            }
        }

    }

}