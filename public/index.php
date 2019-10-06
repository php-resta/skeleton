<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, PUT,DELETE,OPTIONS,HEAD');
header('Access-Control-Allow-Headers: token,apikey,Content-Type');

/**
 * Resta core system composer vendor autoload.
 * For libraries that specify autoload information, Composer generates a vendor/autoload.php file.
 * You can simply include this file and start using the classes that those libraries provide without any extra work
 */
require_once '../bootstrapper'.DIRECTORY_SEPARATOR.'ApplicationStart.php';

use Resta\Foundation\Application;

$app = new Application(false);
echo $app->handle();

