<?php

namespace Store\Services;

use Resta\Support\Arr;
use Resta\Contracts\AccessorContracts;
use Resta\Foundation\ApplicationProvider;

class Config extends ApplicationProvider implements AccessorContracts
{
    /**
     * @var string
     */
    protected $data;

    /**
     * @var object
     */
    private $config;

    /**
     * @var bool
     */
    private $isWithNestedString = false;

    /**
     * @return mixed
     */
    public function get()
    {
        if($this->isWithNestedString){

            $configValues = $this->getConfigValues(true);
            array_shift($configValues);

            $configToArray = $this->config->toArray();

            foreach ($configValues as $item){
                $configToArray = Arr::isset($configToArray,$item);
            }

            return (isset($configToArray)) ? $configToArray : null;
        }

        return $this->config->toArray();
    }

    /**
     * get config values from application
     *
     * @param bool $origin
     * @return mixed
     */
    private function getConfigValues($origin=false)
    {
        $this->isWithNestedString = false;

        $fromStringToArray = explode(".",$this->data);

        if($origin){
            return $fromStringToArray;
        }

        if(count($fromStringToArray)>1){
            $this->isWithNestedString = true;
        }

        $configFile = $this->app['appConfig'][pos($fromStringToArray)]['file'];
        return $this->app->get('fileSystem')->callFile($configFile);

    }

    /**
     * set configuration values
     *
     * @param array $data
     * @return mixed
     */
    public function set($data = array())
    {
        return 'set';
    }

    /**
     * @param $data
     * @return $this
     */
    public function __invoke($data)
    {
        $this->data = $data;

        //get zend config instance
        $configZendInstance = new \Zend\Config\Config($this->getConfigValues());

        $this->config = $configZendInstance;

        return $this;
    }
}