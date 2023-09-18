<?php

namespace App\Controller;

use App\Model\Contact;

class DeleteContactController
{
    public static function deleteById(): void
    {
        if (isset($_GET['id'])) {
            $contactId = (int)$_GET['id']; // Converta para um número inteiro

            $contact = new Contact();

            $result = $contact->deleteById($contactId);

            if ($result) {
                header('Location: /list-contacts');
            } else {
                echo "Erro ao excluir o contato.";
            }
        }
    }
    public static function deleteAll(): void
    {
            $contact = new Contact();
            $contact->deleteAll();
            header('Location: /list-contacts');

    }
}
