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
                return config('database.connections.'.gethostname());
            }
        }

        return [];

    }
}