<?php

namespace App\Kernel\Providers;

use Resta\Support\TrackLogger;
use Resta\Provider\ServiceProviderManager;

class TrackServiceProvider extends ServiceProviderManager
{
    /**
     * register service provider
     *
     * @return void
     */
    public function register()
    {
        /**
         * You must specify path before you can use track log.
         * If the value of track.path is not registered on the container.
         * The system will assign the path to the monolog library by rotatingFileHandler class.
         */
        $this->app->register('track','path',function($arguments){
            $filename = (isset($arguments['path'])) ? lcfirst($arguments['path']) : 'access';
            return app()->path()->appLog().''.DIRECTORY_SEPARATOR.''.date('Y').''.DIRECTORY_SEPARATOR.''.date('m').''.DIRECTORY_SEPARATOR.''.date('d').'-'.$filename.'.log';

        });

        /**
         * track log monitor.You can shape it as you wish.
         * php api track log for console You can monitor your log monitor as project project.
         */
        $this->app->register('track','log',function($output,$arguments=array()){
            if(!isset($arguments['path'])){
                return $this->app->resolve(TrackLogger::class,[
                    'output' => $output,
                    'arguments' => $arguments
                ])
                    ->handle(function(TrackLogger $track){

                    if(isset($track->getOutput()['resource']['errorDetails']['route'])){
                        echo 'Route : '.json_encode($track->getOutput()['resource']['errorDetails']['route']);
                    }

                });
            }

            return $output;

       });
    }
}