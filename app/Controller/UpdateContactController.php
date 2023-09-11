<?php

namespace App\Controller;

use App\Model\Address;
use App\Model\Contact;
use App\Model\Phone;
use Src\config\DatabaseConnection;

class UpdateContactController
{
    public static function updateContact(
        int $contactId,
        string $name,
        string $email,
        string $street,
        string $number,
        string $complement,
        string $zipCode,
        string $city,
        string $state,
        array $phones
    )
    {
        $existingContact = Contact::find($contactId);

        if (!$existingContact) {
            echo "Contato não encontrado.";
            return;
        }

        $existingContact->setName($name);
        $existingContact->setEmail($email);

        $address = $existingContact->getAddress();
        $address->setStreet($street);
        $address->setNumber($number);
        $address->setComplement($complement);
        $address->setZipCode($zipCode);
        $address->setCity($city);
        $address->setState($state);

        foreach ($phones as $phoneData) {
            $areaCode = $phoneData['area_code'];
            $phoneNumber = $phoneData['phone_number'];

            $phone = new Phone($areaCode, $phoneNumber);

            $existingContact->setPhones($phone);
        }

        $success = $existingContact->update();

        if ($success) {
            header('Location: /list-contacts');
            exit();
        } else {
            echo "Erro ao atualizar o contato.";
        }
    }
}