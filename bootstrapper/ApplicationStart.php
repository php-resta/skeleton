<?php

//micro time starter for resta response time
define("time_start",microtime(true));

//root definer: application root path
define("root",str_replace("\\","/",realpath(__DIR__.'/../')));

/**
 * resta system composer vendor autoload.
 * For libraries that specify autoload information, Composer generates a vendor/autoload.php file.
 * You can simply include this file and start using the classes that those libraries provide without any extra work
 * system main skeleton
 * return autoload file
 */
require_once root.''.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

/*
|--------------------------------------------------------------------------
| Application Starting
|--------------------------------------------------------------------------
|
| This class is the starter of your application. This class is used when the
| resta firstly calls.all request coming to application are run here.
| resta starter place
|
*/

//load spl autoload register
(new \Resta\autoloadRegister())->register();