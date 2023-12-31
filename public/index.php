<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Controller\DeleteContactController;
use App\Controller\ListContactsController;
use App\Controller\RegisterContactController;
use App\Controller\UpdateContactController;


//dispacher ( ou frontcontroller) : recebe as requisições e envia para a controller
switch ($_SERVER['PATH_INFO']) {
    default:
    case  '/list-contacts':
        ListContactsController::findAll();
        break;
    case  '/register':
        RegisterContactController::registerRequest();
        break;
    case  '/save-contact':
        if (isset($_GET['id'])) {
            UpdateContactController::updateData();
        }
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
    case 'qualuqe coisa q n faça sentido' :
        http_response_code(404);
        break;

}
