<?php

namespace Store\Packages\Database\Doctrine\Dbal;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Driver\Statement;

class Connection {

    /**
     * @var object $connection
     */
    protected $connection;

    /**
     * Connection constructor.
     */
    public function __construct() {

        $config = new Configuration();
        $this->connection = DriverManager::getConnection($this->configuration(), $config);
    }

    /**
     * @return array
     */
    protected function configuration()
    {
        $settings=config('database');

        $connectionParams = array(
            'dbname'    => $settings['database'],
            'user'      => $settings['user'],
            'password'  => $settings['password'],
            'host'      => $settings['host'],
            'port'      => $settings['port'],
            'driver'    => 'pdo_'.$settings['driver'],
        );

        return $connectionParams;
    }

    /**
     * @param $query
     * @return Statement
     * @throws DBALException
     */
    public static function query($query)
    {
        $instance = new self;
        return $instance->connection->query($query);
    }

}