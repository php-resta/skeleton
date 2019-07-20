<?php

namespace Store\Packages\Search;

/**
 * Class Search
 * @method static ping($params=array())
 * @method static health($params=array())
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