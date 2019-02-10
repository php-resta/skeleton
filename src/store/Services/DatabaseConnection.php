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

            $defaultConnection = config('database.default');

            return config('database.connections.'.$defaultConnection);
        }

        return [];

    }
}