<?php

namespace App\Munch\Api\V1\Model\Entity\Roles\Entity;

/**
* @property $this id
* @property $this name
* @property $this status
* @property $this is_deleted
* @property $this role_state
* @property $this created_at
* @property $this updated_at
*/
class RolesAbstract
{
    /**
     * @var object|null
     */
    protected static $query;
     
    /**
     * roles constructor.
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
    protected static function name()
    {
        return self::$query->name;
    }
            
    /**
     * @return mixed
     */
    protected static function status()
    {
        return self::$query->status;
    }
            
    /**
     * @return mixed
     */
    protected static function is_deleted()
    {
        return self::$query->is_deleted;
    }
            
    /**
     * @return mixed
     */
    protected static function role_state()
    {
        return self::$query->role_state;
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