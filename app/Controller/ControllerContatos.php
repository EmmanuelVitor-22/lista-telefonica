<?php

namespace App\Controller;
require __DIR__ . '/../../vendor/autoload.php';
use App\Model\Address;
use App\Model\Contact;
use App\Model\Phone;

class ControllerContatos
{


    public function saveData():void
    {


        $address = new Address(
            null,
            $_POST['street'],
            $_POST['number'],
            $_POST['complement'],
            $_POST['zipCode'],
            $_POST['city'],
            $_POST['state']
        );


        $contact = new Contact(
            null,
            $_POST['name'],
            $_POST['email'],
            $address
        );

        if ($address->insertAddress()) {

            $id = $address->getAddressId();
            $address->defineId($id);

            $contact->getAddress()->defineId($id);

            if ($contact->insertContato()) {
                $contactId = $contact->getId();

                $phone1 = new Phone(
                    null,
                    $_POST['areaCode1'],
                    $_POST['phoneNumber1'],
                    $contactId
                );

                $phone2 = new Phone(
                    null,
                    $_POST['areaCode2'],
                    $_POST['phoneNumber2'],
                    $contactId
                );

                $phone1->insertPhone();
                $phone2->insertPhone();

                $contact->setPhones($phone1);
                $contact->setPhones($phone2);

                echo "Contato cadastrado com sucesso!";

            } else {
                echo "Erro ao cadastrar o contato.";
            }
        } else {
            echo "Erro ao cadastrar o endereço.";
        }
        require __DIR__ . "/../../public/register-contacts.php";
    }

    public static function findAll()
    {
        $contactObj = new Contact();
        $contacts = $contactObj->findAll();

        require __DIR__ . "/../../public/list-contacts.php";
    }
    public static function registerRequest()
    {
        require __DIR__ . "/../../public/register-contacts.php";
    }
    //pensar em criar um titulo dinamico
}
