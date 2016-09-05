<?php
/**
 * Created by PhpStorm.
 * User: rogerio.lamarques
 * Date: 05/09/2016
 * Time: 11:29
 */

use Lamarques\Application;

require_once __DIR__ . '/vendor/autoload.php';
$config = require __DIR__ . '/config/application.config.php';

try{
    $application = new Application($config);
    $application->start();
} catch (Exception $e){
    echo "<pre>";
    print_r($e);
    echo "<pre>";
}



