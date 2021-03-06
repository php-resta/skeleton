<?php

namespace App\Kernel\Providers;

use ReflectionClass;
use ReflectionMethod;
use Resta\Provider\DeferrableProvider;
use Resta\Provider\ServiceProviderManager;

class EntityServiceProvider extends ServiceProviderManager implements DeferrableProvider
{
    /**
     * register service provider
     *
     * @return void
     */
    public function register() : void
    {
        //get database entities for table
        $this->app->register('entities',function($table){

            $list = [];

            $entityFile = app()->namespace()->model().'\Entity\\'.ucfirst($table).'\\'.ucfirst($table);

            if(class_exists($entityFile)){
                $class = new ReflectionClass($entityFile);
                $methods = $class->getMethods(ReflectionMethod::IS_PROTECTED);

                foreach ($methods as $key=>$object){
                    $list[] = $object->name;
                }
            }

            return $list;
        });
    }

    /**
     * @return array
     */
    public function provides() : array
    {
        return ['entities'];
    }
}