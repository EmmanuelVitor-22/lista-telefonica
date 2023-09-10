<?php
require __DIR__ . '/../vendor/autoload.php';
use App\Controller\ControllerContatos;

include __DIR__ . '/app/View/header.php';
include __DIR__ . '/app/View/list_contacts.php';

switch ($_SERVER['PATH_INFO']){
    case  '/list-contacts':
//    require_once __DIR__ . '/list-contacts.php';
    ControllerContatos::processaDados();
    break;
    case  '/register':
    require_once __DIR__ . '/register.php';
    break;
    default :
        echo "404";
        break;
    
}
