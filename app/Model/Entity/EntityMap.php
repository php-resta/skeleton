<?php

namespace App\Munch\Api\V1\Model\Entity;

use App\Munch\Api\V1\Model\Entity\Order_cancels\Order_cancels;

use App\Munch\Api\V1\Model\Entity\Users\Users;

use App\Munch\Api\V1\Model\Entity\Tableevent\Tableevent;

use App\Munch\Api\V1\Model\Entity\Roles\Roles;

use App\Munch\Api\V1\Model\Entity\Permissions\Permissions;

use App\Munch\Api\V1\Model\Entity\Permission_names\Permission_names;

use App\Munch\Api\V1\Model\Entity\Languages\Languages;

use App\Munch\Api\V1\Model\Entity\Device_tokens\Device_tokens;

use App\Munch\Api\V1\Model\Entity\Orders\Orders;

use App\Munch\Api\V1\Model\Entity\Migrations\Migrations;

class EntityMap
{ 
    /**
     * Order_cancels Entity Instance
     * 
     * @param $query
     * @return Order_cancels
     */
    public function order_cancels($query)
    {
        return new Order_cancels($query);
    }
             
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
     * Tableevent Entity Instance
     * 
     * @param $query
     * @return Tableevent
     */
    public function tableevent($query)
    {
        return new Tableevent($query);
    }
             
    /**
     * Roles Entity Instance
     * 
     * @param $query
     * @return Roles
     */
    public function roles($query)
    {
        return new Roles($query);
    }
             
    /**
     * Permissions Entity Instance
     * 
     * @param $query
     * @return Permissions
     */
    public function permissions($query)
    {
        return new Permissions($query);
    }
             
    /**
     * Permission_names Entity Instance
     * 
     * @param $query
     * @return Permission_names
     */
    public function permission_names($query)
    {
        return new Permission_names($query);
    }
             
    /**
     * Languages Entity Instance
     * 
     * @param $query
     * @return Languages
     */
    public function languages($query)
    {
        return new Languages($query);
    }
             
    /**
     * Device_tokens Entity Instance
     * 
     * @param $query
     * @return Device_tokens
     */
    public function device_tokens($query)
    {
        return new Device_tokens($query);
    }
             
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