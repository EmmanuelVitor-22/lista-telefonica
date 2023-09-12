<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Controller\DeleteContactController;
use App\Controller\RegisterContactController;
use App\Controller\ListContactsController;
use App\Controller\UpdateContactController;


//dispacher ( ou frontcontroller) : recebe as requisições e envia para a controller
switch ($_SERVER['PATH_INFO']) {
    case  '/list-contacts':
        ListContactsController::findAll();
        break;
    case  '/register':
        RegisterContactController::registerRequest();
        break;
    case  '/save-contact':
        RegisterContactController::saveData();
        break;
    case  '/delete':
        DeleteContactController::deleteById();
        break;
    case  '/delete-all':
        DeleteContactController::deleteAll();
        break;
    case  '/update':
            UpdateContactController::displayUpdateForm();
        break;
    case  '/update-contact':
            UpdateContactController::updateContact();
        break;
    default :
        http_response_code(404);
        break;

}
