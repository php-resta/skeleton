<?php

namespace Store\Packages\Database\Doctrine\Dbal;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

class Connection {

    /**
     * @var $connection
     */
    protected $connection;

    /**
     * Connection constructor.
     */
    public function __construct() {

        $config=new Configuration();
        $this->connection = DriverManager::getConnection($this->configuration(), $config);
    }

    /**
     *
     */
    protected function configuration(){

        $settings=config('database');

        $connectionParams = array(
            'dbname' => $settings['database'],
            'user' => $settings['user'],
            'password' =>$settings['password'],
            'host' => $settings['host'],
            'port' => $settings['port'],
            'driver' => 'pdo_'.$settings['driver'],
        );

        return $connectionParams;
    }

    /**
     * @param $query
     * @return \Doctrine\DBAL\Driver\Statement
     * @throws \Doctrine\DBAL\DBALException
     */
    public static function query($query){

        $instance=new self;
        return $instance->connection->query($query);
    }

}