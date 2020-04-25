<?php

namespace Store\Services;

use PDO;

/**
 * Class DB
 * @method static PDO connection()
 * @method static array config($config = array())
 * @method static array fieldTypes($table=null)
 * @method static string nativeType($type=null)
 * @method static string keys($table=null)
 * @method static string uniques($table=null)
 * @package Store\Services
 */
class DB
{
    /**
     * @var null|mixed
     */
    protected static $instance;

    /**
     * @var null|mixed
     */
    protected $connection;

    /**
     * @var null|mixed
     */
    protected $config;

    /**
     * DB constructor.
     * @param null|array $config
     */
    public function __construct($config=null)
    {
        $this->config = (is_null($config)) ? DatabaseConnection::getConfig() : $config;

        if(is_null(self::$instance)){

            //get pdo dsn
            $dsn=''.$this->config['driver'].':host='.$this->config['host'].';dbname='.$this->config['database'].'';
            $this->connection = new PDO($dsn, $this->config['user'], $this->config['password']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            self::$instance = true;
        }
    }

    /**
     * get config
     *
     * @param array $config
     * @return array
     */
    protected function getConfig($config = array()) : array
    {
        if(count($config)){
            $this->config = current($config);
        }

        return $this->config;
    }

    /**
     * get db connection
     *
     * @return PDO
     */
    protected function getConnection()
    {
        return $this->connection;
    }

    /**
     * get native type
     *
     * @param null|string $type
     * @return mixed|null
     */
    protected function getNativeType($type=null) {

        $trans = array(
            'VAR_STRING' => 'string',
            'STRING' => 'string',
            'BLOB' => 'string',
            'LONGLONG' => 'integer',
            'LONG' => 'integer',
            'SHORT' => 'integer',
            'DATETIME' => 'datetime',
            'DATE' => 'date',
            'DOUBLE' => 'float',
            'TIMESTAMP' => 'datetime'
        );

        return isset($trans[$type]) ? $trans[$type] : null ;
    }

    /**
     * get field types
     *
     * @param array $table
     * @return array
     */
    protected function getFieldTypes($table = array())
    {
        $list = [];

        $table = current($table);

        $select = $this->getConnection()->query('SHOW COLUMNS FROM '.$table);

        foreach ($select->fetchAll() as $values){
            if(preg_match('@int@is',$values['Type'])){
                $type = 'integer';
                $list[$values['Field']] = $type;
            }

            elseif(preg_match('@timestamp@is',$values['Type'])){
                $type = 'datetime';
                $list[$values['Field']] = $type;
            }

            elseif(preg_match('@float|double@is',$values['Type'])){
                $type = 'float';
                $list[$values['Field']] = $type;
            }

            else{

                $type = 'string';
                $list[$values['Field']] = $type;
            }
        }

        return $list;
    }

    /**
     * get keys from db
     *
     * @param array $table
     * @return array
     */
    protected function getKeys($table = array())
    {
        $table = current($table);

        return $this->getConnection()->query('SHOW KEYS FROM '.$table)->fetchAll();
    }

    /**
     * get uniques from db
     *
     * @param array $table
     * @return array
     */
    protected function getUniques($table = array()) : array
    {
        $keys = $this->getKeys($table);

        $list = [];

        foreach ($keys as $data){
            if(
                $data['Non_unique']=='0'
                && $data['Key_name']!=='PRIMARY'
            ){
                $list[$data['Key_name']][] = $data['Column_name'];
            }
        }

        return $list;
    }

    /**
     * magic static method for db annotations
     *
     * @param $name
     * @param $arguments
     * @return null|mixed
     */
    public static function __callStatic($name, $arguments)
    {
        if(method_exists($self = new self,$method = 'get'.ucfirst($name))){
            return $self->{$method}($arguments);
        }

        return null;
    }

    /**
     * magic dynamic method for db annotations
     *
     * @param $name
     * @param $arguments
     * @return null|mixed
     */
    public function __call($name, $arguments)
    {
        if(method_exists($self = $this,$method = 'get'.ucfirst($name))){
            return $self->{$method}($arguments);
        }

        return null;
    }
}
