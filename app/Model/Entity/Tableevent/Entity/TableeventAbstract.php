<?php

namespace App\Munch\Api\V1\Model\Entity\Tableevent\Entity;

/**
* @property $this id
* @property $this table_name
* @property $this table_field
* @property $this old_value
* @property $this new_value
* @property $this event_name
* @property $this client_ip
* @property $this auth_id
* @property $this created_at
*/
class TableeventAbstract
{
    /**
     * @var object|null
     */
    protected static $query;
     
    /**
     * tableevent constructor.
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
    protected static function table_field()
    {
        return self::$query->table_field;
    }
            
    /**
     * @return mixed
     */
    protected static function old_value()
    {
        return self::$query->old_value;
    }
            
    /**
     * @return mixed
     */
    protected static function new_value()
    {
        return self::$query->new_value;
    }
            
    /**
     * @return mixed
     */
    protected static function event_name()
    {
        return self::$query->event_name;
    }
            
    /**
     * @return mixed
     */
    protected static function client_ip()
    {
        return self::$query->client_ip;
    }
            
    /**
     * @return mixed
     */
    protected static function auth_id()
    {
        return self::$query->auth_id;
    }
            
    /**
     * @return mixed
     */
    protected static function created_at()
    {
        return self::$query->created_at;
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