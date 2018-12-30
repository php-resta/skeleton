<?php

namespace Store\Packages\Database\Eloquent;

use Illuminate\Database\Capsule\Manager as Capsule;

class Connection
{
    /**
     * @var Capsule $capsule
     */
    public $capsule;

    /**
     * Connection constructor.
     */
    public function __construct()
    {
        $this->capsule = new Capsule;
        $configdb = config('database');

        $this->capsule->addConnection([
            'driver'    => $configdb['driver'],
            'host'      => $configdb['host'],
            'database'  => $configdb['database'],
            'username'  => $configdb['user'],
            'password'  => $configdb['password'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        // Make this Capsule instance available globally via static methods... (optional)
        $this->capsule->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $this->capsule->bootEloquent();
    }
}