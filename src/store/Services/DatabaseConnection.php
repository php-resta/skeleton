<?php

namespace Store\Services;

class DatabaseConnection
{
    /**
     * @return array|null
     */
    public static function getConfig()
    {
        if(config('database')!==null){

            if(app()->has('clusterMethod')){
                $method = app()->get('clusterMethod');
            }
            else{
                $method = httpMethod();
            }

            if(environment() == 'local'){
                return config('database.connections.local');
            }
            else{
                $config = config('database.connections.'.gethostname());

                if(isset($config['read']) && $method=='get'){
                    return $config['read'];
                }

                if(isset($config['write']) && $method!=='get'){
                    return $config['write'];
                }

                return $config;
            }
        }

        return [];

    }
}