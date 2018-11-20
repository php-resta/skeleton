<?php

namespace Store\Services;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class Cache
{
    /**
     * @var string $file
     */
    protected $adapter='file';

    /**
     * @var $cache FilesystemAdapter
     */
    protected $cache;

    /**
     * @var $name
     */
    protected $name;

    /**
     * @var int $expire
     */
    protected $expire=30;

    /**
     * return mixed
     */
    public function file()
    {
        $this->cache = new FilesystemAdapter(
        // the subdirectory of the main cache directory where cache items are stored
            $namespace = '',
            // in seconds; applied to cache items that don't define their own lifetime
            // 0 means to store the cache items indefinitely (i.e. until the files are deleted)
            $defaultLifetime = $this->expire,
            // the main cache directory (the application needs read-write permissions on it)
            // if none is specified, a directory is created inside the system temporary directory
            $directory=app()->path()->appResourche().'/Cache'
        );

    }

    /**
     * @param $name
     * @return $this
     */
    public function name($name)
    {
        //name variable is
        //the name of the cache data set to be created.
        $this->name=$name;
        return $this;
    }

    /**
     * @param $expire
     * @return $this
     */
    public function expire($expire)
    {
        //Cache data is set at the time.
        //Data will be valid in this time.
        $this->expire=$expire;
        return $this;
    }

    /**
     * @param callable $callback
     * @return mixed
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function get(callable $callback)
    {
        //cache adapter state.
        $this->{$this->adapter}();

        //With backtrace, we can specify an automatic name.
        //This will automatically detect which service is running in the service.
        $backtrace=debug_backtrace()[1];

        //If name is null, we name it with backtrace.
        if($this->name===null) {
            $this->name=md5($backtrace['function'].'_'.$backtrace['class']);
        }

        // retrieve the cache item
        $cacheItem = $this->cache->getItem($this->name);

        if (!$cacheItem->isHit()) {

            $data=call_user_func($callback);
            $cacheItem->set($data);
            $this->cache->save($cacheItem);
            return $data;
        }

        // retrieve the value stored by the item
        return $cacheItem->get();
    }

}