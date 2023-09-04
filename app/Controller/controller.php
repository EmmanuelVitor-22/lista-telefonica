<?php



require_once __DIR__ . '/../../vendor/autoload.php';
use App\Controller\ControllerContatos;
try {

$dados = [
        'name' => $_POST["name"],
        'email' => $_POST["email"],
        'street' => $_POST["street"],
        'number' => $_POST["number"],
        'complement' => $_POST["complement"],
        'zipCode' => $_POST["zipCode"],
        'city' => $_POST["city"],
        'state' => $_POST["state"],
        'areaCode1' => $_POST["areaCode1"],
        'phoneNumber1' => $_POST["phoneNumber1"],
        'areaCode2' => $_POST["areaCode2"],
        'phoneNumber2' => $_POST["phoneNumber2"]

    ];

$controller = new ControllerContatos();
$controller->cadastrarDados($dados);

}catch (\Exception $exception){
    echo $exception->getMessage();
}







