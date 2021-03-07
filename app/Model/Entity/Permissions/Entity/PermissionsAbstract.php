<?php

namespace App\Munch\Api\V1\Model\Entity\Permissions\Entity;

/**
* @property $this id
* @property $this name_code
* @property $this route_name
* @property $this role_id
* @property $this created_at
* @property $this updated_at
*/
class PermissionsAbstract
{
    /**
     * @var object|null
     */
    protected static $query;
     
    /**
     * permissions constructor.
     * @param null|object $query
     */
    public function __construct($query)
    {
        self::$query = $query;
    }
            
    /**
     * @return mixed
     */
    protected static function id()
    {
        return self::$query->id;
    }
            
    /**
     * @return mixed
     */
    protected static function name_code()
    {
        return self::$query->name_code;
    }
            
    /**
     * @return mixed
     */
    protected static function route_name()
    {
        return self::$query->route_name;
    }
            
    /**
     * @return mixed
     */
    protected static function role_id()
    {
        return self::$query->role_id;
    }
            
    /**
     * @return mixed
     */
    protected static function created_at()
    {
        return self::$query->created_at;
    }
            
    /**
     * @return mixed
     */
    protected static function updated_at()
    {
        return self::$query->updated_at;
    }
            
    /**
     * access entity object with magic method
     * 
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return static::{$name}();
    }
            

}