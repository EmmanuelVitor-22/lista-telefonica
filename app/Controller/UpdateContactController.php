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

            // Dados dos telefones
            $phones = [];
            for ($i = 1; $i <= 2; $i++) {
                $areaCode = $_POST['inputAreaCode' . $i];
                $phoneNumber = $_POST['inputNumber' . $i];

                if (!empty($areaCode) && !empty($phoneNumber)) {
                    $phones[] = new Phone($areaCode, $phoneNumber);
                }
            }

            $contact = Contact::findById($contactId);
            if (!$contact) {
                echo "Contato não encontrado ou ID inválido.";
                return;
            }

            $address = new Address($contact->getAddress()->getAddressId(), $street, $homeNumber, $complement, $zipCode, $city, $state);
            $contact->setName($name);
            $contact->setEmail($email);
            $contact->setAddress($address);
            $contact->setPhones($phones);

            $success = $contact->update();

            if ($success) {
                header('Location: /list-contacts');
                exit;
            } else {
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
            var_dump($contact->getPhones());
            if ($contact) {
                require __DIR__ . "/../../public/update-contact.php";
                return;
            }
        }

// Trate o cenário em que o contato não foi encontrado ou o parâmetro está ausente
        echo "Contato não encontrado ou ID inválido.";
    }
}

