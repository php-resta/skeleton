<?php
/*
 * This file is request running of the resta system.
 * Once we have the application, we can handle the incoming request
 * through the kernel, and send the associated response back to
 * the client's browser allowing them to enjoy the creative
 * and wonderful application we have prepared for them.
 * developer : aligurbuz['sde']
 * email : galiant781@gmail.com
 * resta api services
 */

error_reporting(0);

//micro time starter for resta response time
define("time_start",microtime(true));

//root definer: application root path
define("root",str_replace("\\","/",dirname(__FILE__)));

/**
 * resta sysmte composer vendor autoload.
 * For libraries that specify autoload information, Composer generates a vendor/autoload.php file.
 * You can simply include this file and start using the classes that those libraries provide without any extra work
 * system main skeleton
 * return autoload file
 */
require_once './vendor/autoload.php';

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

$app=new Resta\Foundation\Application('development');
echo $app->handle();

