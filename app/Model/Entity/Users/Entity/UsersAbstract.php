<?php

namespace App\Model\Entity\Users\Entity;

/**
* @property $this id
* @property $this username
* @property $this name
* @property $this surname
* @property $this gender
* @property $this birthday
* @property $this password
* @property $this email
* @property $this status
* @property $this is_deleted
* @property $this userCode
* @property $this token
* @property $this role_id
* @property $this created_at
* @property $this updated_at
*/
class UsersAbstract
{
    /**
     * @var object|null
     */
    protected static $query;
     
    /**
     * users constructor.
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
    protected static function username()
    {
        return self::$query->username;
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
    protected static function surname()
    {
        return self::$query->surname;
    }
            
    /**
     * @return mixed
     */
    protected static function gender()
    {
        return self::$query->gender;
    }
            
    /**
     * @return mixed
     */
    protected static function birthday()
    {
        return self::$query->birthday;
    }
            
    /**
     * @return mixed
     */
    protected static function password()
    {
        return self::$query->password;
    }
            
    /**
     * @return mixed
     */
    protected static function email()
    {
        return self::$query->email;
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
    protected static function userCode()
    {
        return self::$query->userCode;
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