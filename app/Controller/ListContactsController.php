<?php

namespace App\Controller;

use App\Model\Contact;
require  __DIR__ . '/../Model/Contact.php';

class ListContactsController
{
    public static function findAll(): void
    {
        $contactObj = new Contact();
        $contacts = $contactObj->findAll();
        require __DIR__ . "/../../public/list-contacts.php";
    }

}
