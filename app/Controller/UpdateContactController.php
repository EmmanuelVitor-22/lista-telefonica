<?php

namespace App\Controller;

use App\Model\Address;
use App\Model\Contact;
use App\Model\Phone;
use Src\config\DatabaseConnection;

class UpdateContactController
{
    /**
     * @throws \Exception
     */
    public static function updateContact(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contactId = (int)$_POST['contact_id'];
            $name = $_POST['name'];
            $email = $_POST['email'];

            $street = $_POST['street'];
            $homeNumber = $_POST['homeNumber'];
            $complement = $_POST['complement'];
            $zipCode = $_POST['zip'];
            $city = $_POST['city'];
            $state = $_POST['state'];

            $phoneNumber1 = $_POST['phoneNumber1'];
            $phoneNumber2 = $_POST['phoneNumber2'];
            $areaCode1 = $_POST['areaCode1'];
            $areaCode2 = $_POST['areaCode2'];

            $addressId = Contact::findById($contactId)->getAddress()->getAddressId();

            // Crie objetos de modelo com os dados do formulário
            $updatedAddress = new Address($addressId, $street, $homeNumber, $complement, $zipCode, $city, $state);
            $updatedContact = new Contact($contactId, $name, $email, $updatedAddress);

            // Crie objetos de telefone com os dados do formulário
            $phone1 = new Phone(null,$phoneNumber1, $areaCode1,$contactId);
            $phone2 = new Phone(null,$phoneNumber2, $areaCode2,$contactId);
            $phones = [$phone1, $phone2];

            $updatedContact->setPhones($phones);

            // Execute o método de atualização
            $success = $updatedContact->update();

            if ($success) {
                // Redirecione para uma página de sucesso ou faça qualquer outra ação necessária
                header('Location: /list-contacts');
                exit;
            } else {
                // Trate erros de atualização, por exemplo, exiba uma mensagem de erro
                echo "Erro ao atualizar o contato.";
            }
        }
    }


    /**
     * @throws \Exception
     */
    public static function displayUpdateForm(): void
    {
        if (isset($_GET['id'])) {
            $contactId = (int)$_GET['id'];

            $contact = Contact::findById($contactId);
            if ($contact) {
                require __DIR__ . "/../../public/register-contacts.php";
                return;
            }
        }

// Trate o cenário em que o contato não foi encontrado ou o parâmetro está ausente
        echo "Contato não encontrado ou ID inválido.";
    }
}

