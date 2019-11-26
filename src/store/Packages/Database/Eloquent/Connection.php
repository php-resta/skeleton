<?php

namespace Store\Packages\Database\Eloquent;

use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Store\Services\DatabaseConnection;
use Illuminate\Database\Capsule\Manager as Capsule;

class Connection
{
    /**
     * @var Capsule
     */
    private $capsule;

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
            'strict'    => true,
            'modes'  => [
                //'ONLY_FULL_GROUP_BY',
                'STRICT_TRANS_TABLES',
                'NO_ZERO_IN_DATE',
                'NO_ZERO_DATE',
                'ERROR_FOR_DIVISION_BY_ZERO',
                'NO_ENGINE_SUBSTITUTION',
            ]
        ]);

        // Make this Capsule instance available globally via static methods... (optional)
        $this->capsule->setAsGlobal();

        $this->capsule->setEventDispatcher(new Dispatcher(new Container()));

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $this->capsule->bootEloquent();

    }

    /**
     * get connection for eloquent
     *
     * @return \Illuminate\Database\Connection
     */
    public function getConnection()
    {
        return $this->capsule->getConnection();
    }
}