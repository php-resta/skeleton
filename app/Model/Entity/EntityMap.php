<?php

namespace App\Model\Entity;

use App\Model\Entity\Users\Users;
use App\Model\Entity\Migrations\Migrations;

class EntityMap
{
    /**
     * Users Entity Instance
     * 
     * @param $query
     * @return Users
     */
    public function users($query)
    {
        return new Users($query);
    }
             
    /**
     * Migrations Entity Instance
     * 
     * @param $query
     * @return Migrations
     */
    public function migrations($query)
    {
        return new Migrations($query);
    }
            

}