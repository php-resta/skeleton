<?php

namespace App\Munch\Api\V1\Model\Entity\Device_tokens\Entity;

/**
* @property $this id
* @property $this user_id
* @property $this token
* @property $this token_integer
* @property $this device_agent
* @property $this device_agent_integer
* @property $this expire
* @property $this created_at
* @property $this updated_at
*/
class Device_tokensAbstract
{
    /**
     * @var object|null
     */
    protected static $query;
     
    /**
     * device_tokens constructor.
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
    protected static function user_id()
    {
        return self::$query->user_id;
    }
            
    /**
     * @return mixed
     */
    protected static function token()
    {
        return self::$query->token;
    }
            
    /**
     * @return mixed
     */
    protected static function token_integer()
    {
        return self::$query->token_integer;
    }
            
    /**
     * @return mixed
     */
    protected static function device_agent()
    {
        return self::$query->device_agent;
    }
            
    /**
     * @return mixed
     */
    protected static function device_agent_integer()
    {
        return self::$query->device_agent_integer;
    }
            
    /**
     * @return mixed
     */
    protected static function expire()
    {
        return self::$query->expire;
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