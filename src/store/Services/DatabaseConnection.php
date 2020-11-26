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

            if(environment() == 'local'){
                return config('database.connections.local');
            }
            else{
                $config = config('database.connections.'.gethostname());

                if(isset($config['read']) && httpMethod()=='get'){
                    return $config['read'];
                }

                if(isset($config['write']) && httpMethod()!=='get'){
                    return $config['write'];
                }

                return $config;
            }
        }

        return [];

    }
}