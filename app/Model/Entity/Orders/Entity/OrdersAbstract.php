<?php

namespace App\Munch\Api\V1\Model\Entity\Orders\Entity;

/**
* @property $this id
* @property $this table_code
* @property $this status
* @property $this is_deleted
* @property $this created_at
* @property $this updated_at
*/
class OrdersAbstract
{
    /**
     * @var object|null
     */
    protected static $query;
     
    /**
     * orders constructor.
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
    protected static function table_code()
    {
        return self::$query->table_code;
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