<?php

namespace Controller;

use App\Model\Contact;
use App\Model\Address;
use App\Model\Phone;

require_once __DIR__ . '/../../vendor/autoload.php';

class ControllerContatos
{
    public function exibirFormulario()
    {
        require_once 'View/cadastro.php';
    }

    public function cadastrarContato($postData)
    {
        $name = $postData["name"];
        $email = $postData["email"];
        $street = $postData["street"];
        $number = $postData["number"];
        $complement = $postData["complement"];
        $zipCode = $postData["zipCode"];
        $city = $postData["city"];
        $state = $postData["state"];
        $areaCode = $postData["areaCode"];
        $phoneNumber = $postData["phoneNumber"];

        // Criar objetos de endereço e telefone
        $address = new Address(null, $street, $number, $complement, $zipCode, $city, $state);
        $phone = new Phone(null, $areaCode, $phoneNumber);

        // Criar objeto de contato com endereço e telefone
        $contact = new Contact(null, $name, $email, $address);
        $contact->addPhone($phone);

        // Inserir o contato no banco de dados
        if ($contact->insertContato()) {
            echo "Contato cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o contato.";
        }
    }
}
