<?php

namespace App\Controller;

use App\Model\Address;
use App\Model\Contact;
use App\Model\Phone;

class ControllerContatos
{

    public function cadastrarDados($dados)
    {

        // Criar objetos de endereço e telefone
        $address = new Address(null, $street = $dados['street'], $number = $dados['number'],
            $complement = $dados['complement'], $zipCode = $dados['zipCode'], $city = $dados['city'],
            $state = $dados['state']);

        $contact = new Contact(null, $name = $dados['name'], $email= $dados['email'], $address);
        $phone = new Phone(null, $areaCode1 = $dados['areaCode1'],
            $phoneNumber1 = $dados['phoneNumber1'], $contact->getId());
        $phone2 = new Phone(null, $areaCode2 = $dados['areaCode2'],
            $phoneNumber2 = $dados['phoneNumber1'], $contact->getId());

        // Criar objeto de contato com endereço e telefone
        $contact->setPhones($phone);
        $contact->setPhones($phone2);
        $contact->setAddress($address);

        // Inserir o contato no banco de dados
        if ($contact->insertContato()) {
            print_r($contact);
            echo "Contato cadastrado com sucesso!";

        } else {
            echo "Erro ao cadastrar o contato.";
        }

    }


}