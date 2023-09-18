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
        $street =$_POST['street'];
        $numberHome = $_POST['numberHome'];
        $complement = $_POST['complement'];
        $zipCode = $_POST['zipCode'];
        $city = $_POST['city'];
        $state = $_POST['state'];

        $name = $_POST['name'];
        $email = $_POST['email'];

        $areaCode1 = $_POST['areaCode1'];
        $phoneNumber1 = $_POST['phoneNumber1'];
        $areaCode2 = $_POST['areaCode2'];
        $phoneNumber2 = $_POST['phoneNumber2'];

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
