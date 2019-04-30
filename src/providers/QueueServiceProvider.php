<?php

namespace Providers;

use Resta\Provider\ServiceProviderManager;
use Illuminate\Queue\Capsule\Manager as Queue;

class QueueServiceProvider extends ServiceProviderManager
{
    /**
     * register service provider
     *
     * @return void
     */
    public function register()
    {
        $queue = new Queue;

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