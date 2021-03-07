<?php

namespace App\Munch\Api\V1\Model\Entity\Migrations\Entity;

/**
* @property $this id
* @property $this table_name
* @property $this name
* @property $this created_at
* @property $this updated_at
*/
class MigrationsAbstract
{
    /**
     * @var object|null
     */
    protected static $query;
     
    /**
     * migrations constructor.
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
    protected static function table_name()
    {
        return self::$query->table_name;
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