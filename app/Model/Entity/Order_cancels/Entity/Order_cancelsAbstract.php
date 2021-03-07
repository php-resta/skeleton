<?php

namespace App\Munch\Api\V1\Model\Entity\Order_cancels\Entity;

/**
* @property $this id
* @property $this restaurant_code
* @property $this order_code
* @property $this cancel_note
* @property $this status
* @property $this is_deleted
* @property $this created_at
* @property $this updated_at
*/
class Order_cancelsAbstract
{
    /**
     * @var object|null
     */
    protected static $query;
     
    /**
     * order_cancels constructor.
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
    protected static function restaurant_code()
    {
        return self::$query->restaurant_code;
    }
            
    /**
     * @return mixed
     */
    protected static function order_code()
    {
        return self::$query->order_code;
    }
            
    /**
     * @return mixed
     */
    protected static function cancel_note()
    {
        return self::$query->cancel_note;
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