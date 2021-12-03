<?php

require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("06.09 - Segurança e gestão de senhas");

require __DIR__ . "/source/autoload.php";

//ob_start();
//session();

/*
 * [ password hashing ] Uma API PHP para gerenciamento de senhas de modo seguro.
 */
fullStackPHPClassSession("password hashing", __LINE__);

//$pass = password_hash(12345, PASSWORD_DEFAULT, ["cost" => 12]);
$pass = password_hash(12345, PASSWORD_DEFAULT);

var_dump($pass);

var_dump([
    password_get_info($pass),
    password_needs_rehash($pass, PASSWORD_DEFAULT, ["cost" => 10]),
    password_verify(12345, $pass)
]);

/*
 * [ password saving ] Rotina de cadastro/atualização de senha
 */
fullStackPHPClassSession("password saving", __LINE__);

//$user = (new \Source\Models\User())->load(1);
$user->password = $pass;
//$user->save();

var_dump(password_verify($pass, $user->password));

var_dump($user);

/*
 * [ password verify ] Rotina de vetificação de senha
 */
fullStackPHPClassSession("password verify", __LINE__);

//$login = (new \Source\Models\User())->find("robson1@email.com.br");
var_dump($login);

if(!$login){
//    echo message()->info("E-mail informado não confere!");
}elseif(!password_verify(123456, $login->password)){
    echo message()->error("Senha não confere!!");
}else{
    $login->password = password_hash(123456, PASSWORD_DEFAULT);
    $login->save();

    session()->set("login", $login->data());

    echo message()->seccess("Bem vindo(a) de volta {$login->first_name}!");
    var_dump(session()->all());
}

/*
 * [ password handler ] Sintetizando uso de senhas
 */
fullStackPHPClassSession("password handler", __LINE__);

$pass = "12346546";
var_dump([
    $passwd = passwd($pass),
    passwd_verify($pass, $passwd),
    passwd_rehash($passwd)
]);
//ob_end_flush();