<?php

namespace App\Munch\Api\V1\Model;

use App\Munch\Api\V1\Model\Helper\Scope;
use App\Munch\Api\V1\Model\Helper\Event;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Tableevent
 * @method static $this pagination()
 * @method static $this select($select=array())
 * @method static $this active()
 * @method static $this find($id)
 * @method static $this insert($data=array())
 * @method static $this create($data=array())
 * @method static $this where($field,$value)|where(callable $callback=null)
 * @method static $this get()
 * @method static $this first()
 * @package App\Munch\Api\V1\Tableevent
 */
class Tableevent extends Eloquent
{
    use Scope,Event;

    /**
     * @var string
     */
    protected $table = 'tableevent';

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
        //'photos' => 'Include photos related with tableevent data.',
    ];

}

