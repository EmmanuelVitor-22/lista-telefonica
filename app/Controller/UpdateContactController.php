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
            $contactId = (int)$_POST['id'];

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

            $contact = Contact::findById($contactId);
            //se o id não existir
            if (!$contact) {
                echo "Contato não encontrado";
                return;
            }

            $contact->setName($name);
            $contact->setEmail($email);

            $address = $contact->getAddress();
            $address->setStreet($street);
            $address->setHomeNumber($homeNumber);
            $address->setComplement($complement);
            $address->setZipCode($zipCode);
            $address->setCity($city);
            $address->setState($state);

            $phones = $contact->getPhones();

            if (count($phones) >=2){
                $phones[0]->setAreaCode($areaCode1);
                $phones[0]->setNumber($phoneNumber1);
                $phones[1]->setAreaCode($areaCode2);
                $phones[1]->setNumber($phoneNumber2);
            }else{
                $phones[0]->setAreaCode($areaCode1);
                $phones[0]->setNumber($phoneNumber1);
                $phone2 = new Phone(null, $areaCode2, $phoneNumber2, $contactId);
                $phones[] =$phone2;
                //poderia ter uma verificação caso nn haja nenhum telefone, mas como é reuerido. então, tudo certinho
            }


            $success = $contact->save($contact);

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

