<?php

namespace App\Kernel\Providers;

use Resta\Support\Utils;
use Resta\Provider\ServiceProviderManager;

class ConsoleEventServiceProvider extends ServiceProviderManager
{
    /**
     * register service provider
     *
     * @return void
     */
    public function register()
    {
        //your console events should only be run for the console.
        if($this->app->runningInConsole()){

            // by default we have written a migration event.
            // according to your needs you can write the event.
            event()->addListener('console','default',function($args){
                call_user_func_array([$this,'createControllerForMigrationPull'],[$args]);
                call_user_func_array([$this,'createModelForMigrationPush'],[$args]);
            });
        }
    }

    /**
     * controller file creating for console event
     *
     * @param array $args
     * @return mixed|void
     */
    private function createControllerForMigrationPull($args=array())
    {
        // if there is a value of migration for the argument values,
        // then a controller will be created when that migration is pull.
        if($args['class']=="migration" && $args['classMethod']=="pull" && isset($args['only']) && isset($args['controller'])){

            $only = $args['only'];

            $controller = $args['controller'];

            $modelName = (substr($only,-1)=='s') ? strtolower(substr($only,0,-1)) : strtolower($only);

            if(isset($args['file'])){
                // The symfony process will be executed as an application method.
                $this->app->command('controller create','controller:'.strtolower($controller).' file:'.strtolower($args['file']).' type:crud stub:crudfile model:'.$modelName.' client:'.strtolower($controller).' clientfile:'.strtolower($args['file']).'');
                $this->app->command('client create','name:'.strtolower($controller).' client:'.strtolower($args['file']).'_create trait:'.strtolower($args['file']));
                $this->app->command('client create','name:'.strtolower($controller).' client:'.strtolower($args['file']).'_update trait:'.strtolower($args['file']).'');

                if(isset($args['table'])){

                    $client_controller = ucfirst($controller);
                    $client_file_controller = ucfirst($args['file']);
                    $client_create = $client_file_controller.'_create';
                    $client_update = $client_file_controller.'_update';

                    $clientTrait = $this->app->path()->version().'/Client/'.$client_controller.'/'.$client_file_controller.'Trait.php';
                    $clientCreate = $this->app->path()->version().'/Client/'.$client_controller.'/'.$client_create.'/'.$client_create.'Generator.php';
                    $clientUpdate = $this->app->path()->version().'/Client/'.$client_controller.'/'.$client_update.'/'.$client_update.'.php';

                    files()->change($clientCreate,[
                        'protected $generators = [];' => 'protected $generators = ["'.$modelName.'_code"];',
                        'protected $generators_dont_overwrite = [];' => 'protected $generators_dont_overwrite = ["'.$modelName.'_code"];',
                        'protected function codeGenerator()' => 'protected function '.$modelName.'_codeGenerator()',
                        'return 1;' => 'return codeGenerator($this,$this->expected);',

                    ]);

                    files()->change($clientUpdate,[
                        'protected $expected = [];' => 'protected $expected = ["'.$modelName.'_code"];'

                    ]);

                    $entityTablePath = path()->version().''.DIRECTORY_SEPARATOR.'Client'.DIRECTORY_SEPARATOR.'Entities'.DIRECTORY_SEPARATOR.''.ucfirst($args['table']);
                    $entityTableNamespace = Utils::getNamespace($entityTablePath);


                    files()->change($clientTrait,[
                        'return [];' => 'return $this->builder->'.$modelName.'()->getFillable();',
                        $this->app->namespace()->serviceAnnotations().';' => $this->app->namespace()->serviceAnnotations().'; '.PHP_EOL.'use '.$entityTableNamespace.';',
                        'use ServiceAnnotationsManager;' => 'use ServiceAnnotationsManager,'.ucfirst($args['table']).';'

                    ]);

                    $this->app->command('clientEntity handle','table:'.$args['table']);
                }

            }
            else{

                // The symfony process will be executed as an application method.
                $this->app->command('controller create','controller:'.strtolower($controller).' type:crud stub:crudfile model:'.$modelName.' client:'.strtolower($only).' clientfile:'.strtolower($controller).'');
                $this->app->command('client create','name:'.strtolower($controller).' client:'.strtolower($controller).'_create');
                $this->app->command('client create','name:'.strtolower($controller).' client:'.strtolower($controller).'_update');

                if(isset($args['table'])){

                    $client_controller = ucfirst($controller);
                    $client_create = $client_controller.'_create';
                    $client_update = $client_controller.'_update';

                    $clientTrait = $this->app->path()->version().'/Client/'.$client_controller.'/'.$client_controller.'Trait.php';
                    $clientCreate = $this->app->path()->version().'/Client/'.$client_controller.'/'.$client_create.'/'.$client_create.'Generator.php';
                    $clientUpdate = $this->app->path()->version().'/Client/'.$client_controller.'/'.$client_update.'/'.$client_update.'.php';

                    files()->change($clientCreate,[
                        'protected $generators = [];' => 'protected $generators = ["'.$modelName.'_code"];',
                        'protected $generators_dont_overwrite = [];' => 'protected $generators_dont_overwrite = ["'.$modelName.'_code"];',
                        'protected function codeGenerator()' => 'protected function '.$modelName.'_codeGenerator()',
                        'return 1;' => 'return codeGenerator($this,$this->expected);',

                    ]);

                    files()->change($clientUpdate,[
                        'protected $expected = [];' => 'protected $expected = ["'.$modelName.'_code"];'

                    ]);

                    $entityTablePath = path()->version().''.DIRECTORY_SEPARATOR.'Client'.DIRECTORY_SEPARATOR.'Entities'.DIRECTORY_SEPARATOR.''.ucfirst($args['table']);
                    $entityTableNamespace = Utils::getNamespace($entityTablePath);


                    files()->change($clientTrait,[
                        'return [];' => 'return $this->builder->'.$modelName.'()->getFillable();',
                        $this->app->namespace()->serviceAnnotations().';' => $this->app->namespace()->serviceAnnotations().'; '.PHP_EOL.'use '.$entityTableNamespace.';',
                        'use ServiceAnnotationsManager;' => 'use ServiceAnnotationsManager,'.ucfirst($args['table']).';'

                    ]);

                    $this->app->command('clientEntity handle','table:'.$args['table']);
                }
            }
        }
    }

    /**
     * model file creating for console event
     *
     * @param array $args
     * @return mixed|void
     */
    private function createModelForMigrationPush($args=array())
    {
        // if there is a value of migration create and model for the argument values,
        // then a model will be created when that migration is created.
        if($args['class']=="migration" && $args['classMethod']=="push" && isset($args['table']) && $this->app->isLocale()){

            $args['classMethod'] = 'pull';
            $args['only'] = $args['table'];

            // The symfony process will be executed as an application method.
            $this->createControllerForMigrationPull($args);
        }
    }

    /**
     * controller test file creating for console event
     *
     * @param array $args
     * @return mixed|void
     */
    private function createTestForController($args=array())
    {
        // if there is a value of controller and create for the argument values,
        // then a test file will be created when that controller is created.
        if($args['class']=="controller" && $args['classMethod']=="create" && isset($args['controller'])){

            // The symfony process will be executed as an application method.
            $this->app->command('test create','controller:'.strtolower($args['controller']).'');
        }
    }
}