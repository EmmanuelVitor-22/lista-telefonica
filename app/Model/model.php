<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\Model\Contact;

$ct = new Contact();


//print_r($ct->removeById(2));
print_r($ct->findAll());
