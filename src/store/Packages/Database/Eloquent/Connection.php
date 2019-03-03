<?php

namespace Store\Packages\Database\Eloquent;

use Store\Services\DatabaseConnection;
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

        $configdb = DatabaseConnection::getConfig();

        $this->capsule->addConnection([
            'driver'    => (isset($configdb['driver'])) ? $configdb['driver'] : 'mysql' ,
            'host'      => (isset($configdb['host'])) ? $configdb['host'] : '127.0.0.1',
            'database'  => (isset($configdb['database'])) ? $configdb['database'] : 'test',
            'username'  => (isset($configdb['user'])) ? $configdb['user'] : 'root',
            'password'  => (isset($configdb['password'])) ? $configdb['password'] : 'root',
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