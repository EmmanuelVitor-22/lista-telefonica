<?php

namespace App\Controller;

use App\Model\Contact;

class ListContactsController
{

    public static function findAll()
    {
        $contactObj = new Contact();
        $contacts = $contactObj->findAll();

        require __DIR__ . "/../../public/list-contacts.php";
    }

}