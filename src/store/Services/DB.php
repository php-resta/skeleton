<?php

namespace Store\Services;

use PDO;

/**
 * Class DB
 * @method static PDO connection()
 * @method static array config()
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
    private static $instance;

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

            self::$instance=true;
        }
    }

    /**
     * get config
     *
     * @return array
     */
    public function getConfig() : array
    {
        return $this->config;
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param null|string $type
     * @return mixed|null
     */
    public function getNativeType($type=null) {

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

    public function getFieldTypes($table=null)
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

    public function getKeys($table)
    {
        $table = current($table);

        return $this->getConnection()->query('SHOW KEYS FROM '.$table)->fetchAll();
    }

    /**
     * @param $table
     * @return array
     */
    public function getUniques($table) : array
    {
        $keys = $this->getKeys($table);

        $list = [];

        foreach ($keys as $data){
            if($data['Non_unique']=='0' && $data['Key_name']!=='PRIMARY'){
                $list[$data['Key_name']][] = $data['Column_name'];
            }
        }

        return $list;
    }

    /**
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
}
