<?php

namespace Providers;

use Illuminate\Container\Container;
use Resta\Provider\ServiceProviderManager;
use Illuminate\Queue\Capsule\Manager as Queue;
use Illuminate\Database\DatabaseServiceProvider;

class QueueServiceProvider extends ServiceProviderManager
{
    /**
     * register service provider
     *
     * @return void
     */
    public function register()
    {
        $container = new Container();

        $databaseServiceProvider = new DatabaseServiceProvider($container);
        $databaseServiceProvider->register();
        $databaseServiceProvider->boot();

        $queue = new Queue($container);

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