<?php

namespace App\Model;

use App\Model\Helper\Scope;
use App\Model\Helper\Event;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class User
 * @method static $this pagination()
 * @method static $this select($select=array())
 * @method static $this active()
 * @method static $this find($id)
 * @method static $this insert($data=array())
 * @method static $this create($data=array())
 * @method static $this where($field,$value)|where(callable $callback=null)
 * @method static $this get()
 * @method static $this first()
 * @package App\Model\User
 */
class User extends Eloquent
{
    use Scope,Event;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @var array
     */
    protected $hidden = ['id'];

    /**
     * @var array
     */
    protected $forbidden = ['id'];

    /**
     * @var array
     */
    protected $relationWith = [
        //'photos' => 'Include photos related with users data.',
    ];

}

