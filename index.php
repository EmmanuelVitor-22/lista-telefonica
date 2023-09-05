<?php

include __DIR__ . '/app/View/header.php';
include __DIR__ . '/app/View/list_contacts.php';

switch ($_SERVER['PATH_INFO']){
    case  '/list-contacts':
    require_once __DIR__ . '/public/list-contacts.php';
    break;
    case  '/register':
    require_once __DIR__ . '/public/register.php';
    break;
    default :
        echo "404";
        break;
    
}
