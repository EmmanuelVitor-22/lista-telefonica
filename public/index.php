<?php
require __DIR__ . '/../vendor/autoload.php';
use App\Controller\ControllerContatos;


//dispacher ( ou frontcontroller) : recebe as requisições e envia para a controller
switch ($_SERVER['PATH_INFO']){
    case  '/list-contacts':
        ControllerContatos::findAll();
    break;
    case  '/register':
        ControllerContatos::registerRequest();
    break;
    default :
        echo "404";
        break;
    
}
