<?php

namespace App\Model\Entity;

use App\Model\Entity\Users\Users;
use App\Model\Entity\Migrations\Migrations;

class EntityMap
{ 
    /**
     * Orders Entity Instance
     * 
     * @param $query
     * @return Orders
     */
    public function orders($query)
    {
        return new Orders($query);
    }
             
    /**
     * Users Entity Instance
     * 
     * @param $query
     * @return Users
     */
    public function users($query): Users
    {
        return new Users($query);
    }
             
    /**
     * Migrations Entity Instance
     * 
     * @param $query
     * @return Migrations
     */
    public function migrations($query): Migrations
    {
        return new Migrations($query);
    }
            

}