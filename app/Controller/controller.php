<?php

require_once __DIR__ . '/../../vendor/autoload.php';
use App\Controller\ControllerContatos;



$dados = [
    'name' => $_POST["name"] ?? 'a',
    'email' => $_POST["email"] ?? 'a',
    'street' => $_POST["street"] ?? 'a',
    'number' => $_POST["number"] ?? 'a',
    'complement' => $_POST["complement"] ?? 'a',
    'zipCode' => $_POST["zipCode"] ?? 'a',
    'city' => $_POST["city"] ?? 'a',
    'state' => $_POST["state"] ?? 'a',
    'areaCode1' => $_POST["areaCode1"] ?? 'a',
    'phoneNumber1' => $_POST["phoneNumber1"] ?? 'a',
    'areaCode2' => $_POST["areaCode2"] ?? 'a',
    'phoneNumber2' => $_POST["phoneNumber2"] ?? 'a',
];

$controller = new ControllerContatos();
$controller->cadastrarDados($dados);









