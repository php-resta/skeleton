<?php

namespace Providers;

use Illuminate\Container\Container;
use Resta\Provider\ServiceProviderManager;
use Illuminate\Events\EventServiceProvider;
use Illuminate\Queue\Capsule\Manager as Queue;
use Illuminate\Database\DatabaseServiceProvider;

class QueueServiceProvider extends ServiceProviderManager
{
    /**
     * @var \Illuminate\Contracts\Foundation\Application $container
     */
    protected $container;

    /**
     * register service provider
     *
     * @return void
     */
    public function register()
    {
        $this->container = new Container();

        $eventServiceProvider = new EventServiceProvider($this->container);
        $eventServiceProvider->register();

        $databaseServiceProvider = new DatabaseServiceProvider($this->container);
        $databaseServiceProvider->register();
        $databaseServiceProvider->boot();

        $queue = new Queue($this->container);

        $queue->addConnection([
            'driver' => 'database',
            'table' => 'jobs',
            'queue' => 'default',
            'retry_after' => 90,
        ]);

        // Make this Capsule instance available globally via static methods... (optional)
        $queue->setAsGlobal();

        //container register for queue
        $this->app->register('queue',$queue);
    }
}