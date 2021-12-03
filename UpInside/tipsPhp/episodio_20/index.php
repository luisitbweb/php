<?php

require __DIR__ . "/vendor/autoload.php";

use Source\Models\User;

$user = new User();
//$user = new (User())->findById();
$user->first_name = "repeti teste";
$user->last_name = " test caros";
$user->genre = "M";
$user->email = "luiscarloss2018@outlook.com";
$user->password = "12395";

if(!$user->save()){
    echo "<h3>Ooops: {$user->fail()->getMessage()}</h3>";
}

echo "<h2>Usuario:</h2>";
var_dump($user->data());