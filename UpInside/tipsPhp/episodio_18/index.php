<?php

require __DIR__ . "/vendor/autoload.php";

use Source\Models\User;

$userCreate = false;
if ($userCreate) {
    $user = new User();
    $user->first_name = "Brother";
    $user->last_name = "Carlos";
    $user->genre = "M";
    $user->email = "luis@ig.com.br";
    $user->password = password_hash("123456", PASSWORD_DEFAULT);
//    $user->password = password_hash("123456", PASSWORD_DEFAULT, ["cost" => 15]);

    if ($user->save()) {
        echo "<h2>Usuário Cadastrado: {$user->id}</h2>";
    } else {
        echo "<h2>{$user->fail()->getMessage()}</h2>";
    }
}

/**
 * LOAD USER
 */
echo "<h1>User:</h1>";
$user = (new User())->findById(9);
var_dump($user->data());

/**
 * LOGIN EXEMPLO
 */
echo "<h1>Login:</h1>";
$email = "luisitb@ig.com.br";
$pass = "123456";

$login = (new User())->find("email = :e", "e={$email}")->fetch();

if (!$login || !password_verify($pass, $login->password)) {
    echo "<h2>Login ou senha não conferem</h2>";
} else {
    echo "<h2>login efetuado!</h2>";
}

var_dump($login->data());

/**
 * TEST HASH
 */
echo "<h1>INFO AND IF REHASH</h1>";
var_dump(
    password_get_info($user->password),
    password_needs_rehash($user->password, PASSWORD_DEFAULT),
    password_needs_rehash($user->password, PASSWORD_DEFAULT, ["cost" => 15])
);

$user->password = password_hash($pass, PASSWORD_DEFAULT, ["cost" => 15]);
$user->password = password_hash($pass, PASSWORD_DEFAULT);
$user->save();