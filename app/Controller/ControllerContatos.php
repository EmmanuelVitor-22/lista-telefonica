<?php



require_once __DIR__ . '/../../vendor/autoload.php';
use App\Model\Contact;
use App\Model\Address;
use App\Model\Phone;

try {

        $name = $_POST["name"] = 'a';
        $email = $_POST["email"] = 'a';
        $street = $_POST["street"] = 'a';
        $number = $_POST["number"] = 'a';
        $complement = $_POST["complement"] = 'a';
        $zipCode = $_POST["zipCode"] = 'a';
        $city = $_POST["city"] = 'a';
        $state = $_POST["state"] = 'a';
        $areaCode1 = $_POST["areaCode1"] = 'a';
        $phoneNumber1 = $_POST["phoneNumber1"] = 'a';
        $areaCode2 = $_POST["areaCode2"] = 'a';
        $phoneNumber2 = $_POST["phoneNumber2"] = 'a';

        // Criar objetos de endereço e telefone
        $contact = new Contact(null, $name, $email, new Address());
        $address = new Address(null, $street, $number, $complement, $zipCode, $city, $state);
        $phone = new Phone(null, $areaCode1, $phoneNumber1, $contact->getId());
        $phone2 = new Phone(null, $areaCode2, $phoneNumber2, $contact->getId());

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

}catch (\Exception $exception){
    echo $exception->getMessage();
}





