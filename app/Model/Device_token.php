<?php

namespace App\Model;

use App\Model\Helper\Scope;
use App\Model\Helper\Event;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Device_token
 * @method static $this pagination()
 * @method static $this select($select=array())
 * @method static $this active()
 * @method static $this find($id)
 * @method static $this insert($data=array())
 * @method static $this create($data=array())
 * @method static $this where($field,$value)|where(callable $callback=null)
 * @method static $this get()
 * @method static $this first()
 * @package App\Munch\Api\V1\Device_token
 */
class Device_token extends Eloquent
{
    use Scope,Event;

    /**
     * @var string
     */
    protected $table = 'device_tokens';

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
        //'photos' => 'Include photos related with device_tokens data.',
    ];

}

