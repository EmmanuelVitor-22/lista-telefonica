<?php
$a = [
$name = $_POST['name'],
$email = $_POST['email'],

$street =  $_POST['street'],
$number =  $_POST['homeNumber'],
$complement =  $_POST['complement'],
$zip_code = $_POST['zip'],
$city =  $_POST['city'],
$state =  $_POST['state']
];

foreach ($a as $key => $item) {
    echo "<pre>" . $key . "-> " . $item . PHP_EOL ."</pre>" ;
}

