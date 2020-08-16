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
                $defaultConnection = config('database.default');
                return config('database.connections.'.$defaultConnection);
            }
            else{
                return config('database.connections.'.gethostname());
            }
        }

        return [];

    }
}