<?php

namespace Store\Services;

use PDO;
use Resta\Support\Utils;
use Resta\Support\Generator\Generator;
use Resta\Exception\FileNotFoundException;

/**
 * Class DB
 * @method static PDO connection()
 * @method static array config($config = array())
 * @method static array fieldTypes($table=null)
 * @method static array fields($table=null)
 * @method static array generateEntity($table=null)
 * @method static array columns($table=null)
 * @method static string nativeType($type=null)
 * @method static string keys($table=null)
 * @method static string uniques($table=null)
 * @method static array tables()
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
    protected static $connection;

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

        if(is_null(self::$connection)){

            //get pdo dsn
            $dsn=''.$this->config['driver'].':host='.$this->config['host'].';dbname='.$this->config['database'].'';
            static::$connection = new PDO($dsn, $this->config['user'], $this->config['password']);
            static::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
        return static::$connection;
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
    protected function getFields($table = array())
    {
        $list = [];

        $table = current($table);

        $select = $this->getConnection()->query('SHOW COLUMNS FROM '.$table);

        foreach ($select->fetchAll() as $values){
            $list[] = $values['Field'];
        }

        return $list;
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
     * get keys from db
     *
     * @param array $table
     * @return array
     */
    protected function getColumns($table = array())
    {
        $table = current($table);

        return $this->getConnection()->query('SHOW FULL COLUMNS FROM '.$table)->fetchAll();
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
     * get tables from database
     *
     * @return array
     */
    protected function getTables()
    {
        $list = [];
        
        $dbTables = $this->getConnection()->query('SHOW TABLES FROM '.$this->config['database'])->fetchAll();

        foreach ($dbTables as $dbTable) {
            $list[] = $dbTable['Tables_in_devmunch'];
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
     * generate entity for database columns
     *
     * @param $table
     *
     * @throws FileNotFoundException
     */
    public function getGenerateEntity($table)
    {
        $columns = $this->getColumns($table);

        $table = current($table);

        $entityDirectory = path()->model().''.DIRECTORY_SEPARATOR.'Entity';

        if(!file_exists(app()->path()->model())){
            files()->makeDirectory(app()->path()->model());
        }

        if(!file_exists($entityDirectory)){
            files()->makeDirectory($entityDirectory);
        }

        $list = [];

        foreach ($columns as $column) {
            $list[] = $column['Field'];
        }

        if(!file_exists($entityDirectory.''.DIRECTORY_SEPARATOR.''.ucfirst($table))){
            $generator = new Generator($entityDirectory.''.DIRECTORY_SEPARATOR.''.ucfirst($table),$table.'');
            $generator->createClass();
        }
        else{
            $generator = new Generator($entityDirectory.''.DIRECTORY_SEPARATOR.''.ucfirst($table),$table.'');
        }


        $abstractClassPath = $entityDirectory.''.DIRECTORY_SEPARATOR.''.ucfirst($table).''.DIRECTORY_SEPARATOR.'Entity';
        $abstractNamespace = Utils::getNamespace($abstractClassPath.''.DIRECTORY_SEPARATOR.''.ucfirst($table).'Abstract');

        $generator->createClassExtend($abstractNamespace,ucfirst($table).'Abstract');

        $generator = new Generator($abstractClassPath,$table.'Abstract');

        $generator->createClass();

        $method =array_merge([
            '__construct'
        ],array_merge($list,['__get']));

        $generator->createMethod($method);

        $generator->createMethodParameters([
            '__construct' => '$query',
            '__get' => '$name'
        ]);

        $methodBodyList = [];
        $createMethodAccessibleProperty = [];
        $createMethodDocument = [];
        $createClassDocument = [];

        foreach ($list as $item) {
            $methodBodyList[$item] = 'return self::$query->'.$item.';';
            $createClassDocument[] = '@property $this '.$item;
            $createMethodAccessibleProperty[$item] = 'protected static';
            $createMethodDocument[$item] = [
                '@return mixed'
            ];
        }

        $generator->createClassDocument($createClassDocument);

        $generator->createMethodDocument(array_merge($createMethodDocument,[
            '__construct' => [
                ''.$table.' constructor.',
                '@param null|object $query'
            ],
            '__get' =>[
                'access entity object with magic method',
                '',
                '@param $name',
                '@return mixed'
            ]
        ]));

        $createMethodBody = array_merge([
            '__construct' => 'self::$query = $query;',
            '__get' => 'return static::{$name}();'
        ],$methodBodyList);

        $generator->createMethodBody($createMethodBody);

        $generator->createMethodAccessibleProperty($createMethodAccessibleProperty);


        $generator->createClassProperty([
            'protected static $query;'
        ]);

        $generator->createClassPropertyDocument([
            'protected static $query' => [
                '@var object|null'
            ]
        ]);
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
