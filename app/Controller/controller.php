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
    'areaCode1' => $_POST["areaCode1"] ?? '55',
    'phoneNumber1' => $_POST["phoneNumber1"] ?? '75982170090',
    'areaCode2' => $_POST["areaCode2"] ?? '56',
    'phoneNumber2' => $_POST["phoneNumber2"] ?? '75982170091',
];

$controller = new ControllerContatos();
$controller->cadastrarDados($dados);









