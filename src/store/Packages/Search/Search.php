<?php

namespace Store\Packages\Search;

/**
 * Class Search
 * @method static ping($params=array())
 * @method static health($params=array())
 * @method static getNodeStats()
 * @method static getIndexStats()
 * @method static getClusterStats()
 * @method static getAll($params=array())
 * @method static getSource($params=array())
 * @method static deleteIndex($index=null)
 * @method static indexExists($index=null)
 * @method static indexCreate($index=null)
 * @method static existsType($index=null,$type=null)
 * @method static setMap($data=array())
 * @method static create($data=array())
 * @method static search($match,$fields=array())
 * @package Store\Packages\Search
 */
class Search
{
    /**
     * connection search driver namespace
     *
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        $driver = config('search.default');

        $searchManager = 'Store\\Packages\\Search\\'.$driver.'\\Manager';

        $instance = new $searchManager(config('search.connections.'.$driver));

        return $instance->{$name}($arguments);
    }
}