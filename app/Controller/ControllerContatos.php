<?php

namespace App\Controller;

use App\Model\Address;
use App\Model\Contact;
use App\Model\Phone;

class ControllerContatos
{
    public function cadastrarDados($dados)
    {
        $address = new Address(
            null,
            $dados['street'],
            $dados['number'],
            $dados['complement'],
            $dados['zipCode'],
            $dados['city'],
            $dados['state']
        );


        $contact = new Contact(
            null,
            $dados['name'],
            $dados['email'],
            $address
        );

        if ($address->insertAddress()) {
            $id = $address->getAddressId();
            $address->defineId($id);
//            $addressId = $address->getAddressId();

            $contact->getAddress()->defineId($id);

            if ($contact->insertContato()) {
                $contactId = $contact->getId();

                $phone1 = new Phone(
                    null,
                    $dados['areaCode1'],
                    $dados['phoneNumber1'],
                    $contactId
                );

                $phone2 = new Phone(
                    null,
                    $dados['areaCode2'],
                    $dados['phoneNumber2'],
                    $contactId
                );

                $phone1->insertPhone();
                $phone2->insertPhone();

                echo "Contato cadastrado com sucesso!";
                echo '<pre>';
                var_dump($contact);
                echo '</pre>';
            } else {
                echo "Erro ao cadastrar o contato.";
            }
        } else {
            echo "Erro ao cadastrar o endereço.";
        }
    }


}
