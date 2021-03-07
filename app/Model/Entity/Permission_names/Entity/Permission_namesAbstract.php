<?php

namespace App\Munch\Api\V1\Model\Entity\Permission_names\Entity;

/**
* @property $this id
* @property $this code
* @property $this name
* @property $this lang
* @property $this created_at
* @property $this updated_at
*/
class Permission_namesAbstract
{
    /**
     * @var object|null
     */
    protected static $query;
     
    /**
     * permission_names constructor.
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
    protected static function code()
    {
        return self::$query->code;
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
    protected static function lang()
    {
        return self::$query->lang;
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