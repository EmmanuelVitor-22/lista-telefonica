<?php

namespace App\Controller;

use App\Model\Address;
use App\Model\Contact;
use App\Model\Phone;
use Src\config\DatabaseConnection;

class UpdateContactController
{
//    public static function updateContact(
//        int $contactId,
//        string $name,
//        string $email,
//        string $street,
//        string $number,
//        string $complement,
//        string $zipCode,
//        string $city,
//        string $state,
//        array $phones
//    )
//    {
//        $existingContact = Contact::find($contactId);
//
//        if (!$existingContact) {
//            echo "Contato não encontrado.";
//            return;
//        }
//
//        $existingContact->setName($name);
//        $existingContact->setEmail($email);
//
//        $address = $existingContact->getAddress();
//        $address->setStreet($street);
//        $address->setNumber($number);
//        $address->setComplement($complement);
//        $address->setZipCode($zipCode);
//        $address->setCity($city);
//        $address->setState($state);
//
//        foreach ($phones as $phoneData) {
//            $areaCode = $phoneData['area_code'];
//            $phoneNumber = $phoneData['phone_number'];
//
//            $phone = new Phone($areaCode, $phoneNumber);
//
//            $existingContact->setPhones($phone);
//        }
//
//        $success = $existingContact->update();
//
//        if ($success) {
//            header('Location: /list-contacts');
//            exit();
//        } else {
//            echo "Erro ao atualizar o contato.";
//        }
//    }




    public static function updateContact(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contactId = $_POST['contact_id'];
            $name = $_POST['name'];
            $email = $_POST['email'];

            // Obtenha os valores para o endereço
            $addressId = $_POST['address_id'];
            $street = $_POST['street'];
            $number = $_POST['number'];
            $complement = $_POST['complement'];
            $zipCode = $_POST['zip_code'];
            $city = $_POST['city'];
            $state = $_POST['state'];

            // Crie um objeto Address com os dados atualizados
            $updatedAddress = new Address($addressId, $street, $number, $complement, $zipCode, $city, $state);
            $updatedContact = new Contact($contactId, $name, $email, $updatedAddress);

            // Obtenha os valores para os telefones por meio de um array
            $phones = $_POST['phone']; // Supondo que 'phone' seja um array de telefones

            $updatedPhones = [];

            // Itere pelo array de telefones e crie objetos Phone
            foreach ($phones as $phoneData) {
                $phoneId = $phoneData['phone_id'];
                $areaCode = $phoneData['area_code'];
                $phoneNumber = $phoneData['phone_number'];

                $updatedPhone = new Phone($phoneId, $areaCode, $phoneNumber, $contactId);
                $updatedPhones[] = $updatedPhone;
            }
            $updatedContact->setPhones($updatedPhones);

            // Chame a função de update
            $success = $updatedContact->update();

            if ($success) {
                // Redirecione para uma página de sucesso ou faça qualquer outra ação necessária
                header('Location: success.php');
                exit;
            } else {
                // Trate erros de atualização, por exemplo, exiba uma mensagem de erro
                echo "Erro ao atualizar o contato.";
            }
        }
    }

    // URL: /update?contact_id=1

    /**
     * @throws \Exception
     */
    public static function displayUpdateForm(): void
    {
        if (isset($_GET['id'])) {
            $contactId = (int)$_GET['id'];

            $contact = Contact::findById($contactId);

            if ($contact) {
                require __DIR__ . "/../../public/update-contact.php";
                return;
            }
        }

        // Trate o cenário em que o contato não foi encontrado ou o parâmetro está ausente
        echo "Contato não encontrado ou ID inválido.";
    }

//    public static function updateRequest():void
//    {
//        $contact = new Contact();
//        require __DIR__ . "/../../public/update-contact.php";
//
//
//    }
}
