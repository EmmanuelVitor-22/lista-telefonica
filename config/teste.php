<?php


use Src\config\Connection;

require __DIR__ .'/../vendor/autoload.php';


$obj = new Connection();
$t = __DIR__ . '/../env.php';
print_r($obj->setAttribute($t));
