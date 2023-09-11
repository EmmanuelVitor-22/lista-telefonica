<?php

namespace App\Controller;

use App\Model\Contact;

class DeleteContactController
{
    public static function deleteById()
    {
        // Verifique se o ID do contato foi fornecido na URL
        if (isset($_GET['id'])) {
            $contactId = (int)$_GET['id']; // Converta para um número inteiro

            $contact = new Contact();

            // Chame o método deleteById do modelo Contact
            $result = $contact->deleteById($contactId);

            if ($result) {
                echo "Contato excluído com sucesso.";
            } else {
                echo "Erro ao excluir o contato.";
            }
        } else {
            echo "ID do contato não fornecido na URL.";
        }
    }
}
