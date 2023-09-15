<?php

namespace App\Controller;
require __DIR__ . '/../../vendor/autoload.php';
use App\Model\Address;
use App\Model\Contact;
use App\Model\Phone;

class RegisterContactController
{


    public static function saveData(): void
    {
        // Dar segurança ao input
        $street = htmlspecialchars($_POST['street']);
        $numberHome = filter_var($_POST['numberHome'], FILTER_SANITIZE_NUMBER_INT);
        $complement = htmlspecialchars($_POST['complement']);
        $zipCode = htmlspecialchars($_POST['zipCode']);
        $city = htmlspecialchars($_POST['city']);
        $state = htmlspecialchars($_POST['state']);

        $name = filter_var($_POST['name']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        $areaCode1 = filter_var($_POST['areaCode1'], FILTER_SANITIZE_NUMBER_INT);
        $phoneNumber1 = filter_var($_POST['phoneNumber1'], FILTER_SANITIZE_NUMBER_INT);
        $areaCode2 = filter_var($_POST['areaCode2'], FILTER_SANITIZE_NUMBER_INT);
        $phoneNumber2 = filter_var($_POST['phoneNumber2'], FILTER_SANITIZE_NUMBER_INT);

        $address = new Address(
            null,
            $street,
            $numberHome,
            $complement,
            $zipCode,
            $city,
            $state
        );

        $contact = new Contact(
            null,
            $name,
            $email,
            $address
        );

        if ($address->insertAddress()) {
            $id = $address->getAddressId();
            $address->defineId($id);
            $contact->getAddress()->defineId($id);

            // Chame o método save() em vez de insertContato()
            if ($contact->save($contact)) {
                $contactId = $contact->getId();

                $phones = [];
                $phone1 = new Phone(
                    null,
                    $areaCode1,
                    $phoneNumber1,
                    $contactId
                );

                $phone2 = new Phone(
                    null,
                    $areaCode2,
                    $phoneNumber2,
                    $contactId
                );

                $phone1->insertPhone();
                $phone2->insertPhone();

                $phones[] = $phone1;
                $phones[] = $phone2;

                $contact->setPhones($phones);

                header('Location: /list-contacts'); // Corrected header function argument.

            } else {
                http_response_code(404);
            }
        } else {
            http_response_code(404);
        }
    }




    public static function registerRequest(): void
    {
        require __DIR__ . "/../../public/form-contact.php";
    }
    //pensar em criar um titulo dinamico
}
