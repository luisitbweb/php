<?php

require __DIR__ . "/vendor/autoload.php";

use Faker\Factory;
use Source\Models\User;

$faker = Factory::create("pt-BR");
$users = (new User())->find()->fetch(true);

if(!$users){

    for($i = 0; $i < 3; $i++){
        $user = new User();
        $user->first_name = $faker->firstName;
        $user->last_name = $faker->lastName;
        $user->email = $faker->email;
        $user->passwd = password_hash($faker->password, PASSWORD_DEFAULT);
        $user->save();

    }

    echo "<h3>{$i} Usuários Cadastrados!</h3>";
}else{
    echo "<h3>Usuários: </h3>";

    foreach ($users as $user){
        $user->first_name = $faker->firstName;
        $user->last_name = $faker->lastName;
        $user->save();
        var_dump($user->data());
    }

    $userSave = new User();
    $userSave->first_name = "Robson";
    $userSave->last_name = "Da Silva Santos";
    $userSave->email = "luisitb@ig.com.br";
    $userSave->passwd = password_hash($faker->password, PASSWORD_DEFAULT);
    $save = $userSave->save();

    if($save){
        var_dump($userSave->data());
    }else{
        echo "<h1>{$userSave->fail()->getMessage()}</h1>";
    }
}