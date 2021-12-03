<?php

require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("05.05 - Explorando estilos de busca");

require __DIR__ . './source/autoload.php';

use Source\Database\Connect;

/*
 * [ fetch ] http://php.net/manual/pt_BR/pdostatement.fetch.php
 */
fullStackPHPClassSession("fetch", __LINE__);

$connect = Connect::getInstance();
$read = $connect->query("SELECT * FROM users LIMIT 3");

if (!$read->rowCount()) {
    echo "<p class='trigger warning'>Não obteve resultados.</p>";
} else {
    // var_dump($read->fetch());

    while ($user = $read->fetch()) {
        echo '<pre>';
        var_dump($user);
        echo '</pre>';
    }

    echo '<pre>';
    var_dump($user);
    echo '</pre>';
}

/*
 * [ fetch all ] http://php.net/manual/pt_BR/pdostatement.fetchall.php
 */
fullStackPHPClassSession("fetch all", __LINE__);

$read1 = $connect->query("SELECT * FROM users LIMIT 3,2");

//while($user = $read1->fetchAll()){
//    var_dump($read1);
//}

foreach ($read1->fetchAll() as $user) {
    echo '<pre>';
    var_dump($user);
    echo '</pre>';
}

echo '<pre>';
var_dump($read1->fetchAll());
echo '</pre>';

/*
 * [ fetch save ] Realziar um fetch diretamente em um PDOStatement resulta em um clear no buffer da consulta. Você
 * pode armazenar esse resultado em uma variável para manipilar e exibir posteriormente.
 */
fullStackPHPClassSession("fetch save", __LINE__);

$read2 = $connect->query("SELECT * FROM users LIMIT 5,1");
$result = $read2->fetchAll();

echo '<pre>';
var_dump(
        $read2->fetchAll(),
        $result,
        $result
);
echo '</pre>';

/*
 * [ fetch modes ] http://php.net/manual/pt_BR/pdostatement.fetch.php
 */
fullStackPHPClassSession("fetch styles", __LINE__);

$read3 = $connect->query("SELECT * FROM users LIMIT 11,1");
foreach ($read3->fetchAll() as $user){
    echo '<pre>';
    var_dump($user, $user->first_name);
    echo '</pre>';
}

$read4 = $connect->query("SELECT * FROM users LIMIT 11,1");
foreach ($read4->fetchAll(PDO::FETCH_NUM) as $user){
    echo '<pre>';
    var_dump($user, $user[1]);
    echo '</pre>';
}

$read5 = $connect->query("SELECT * FROM users LIMIT 11,1");
foreach ($read5->fetchAll(PDO::FETCH_ASSOC) as $user){
    echo '<pre>';
    var_dump($user, $user['first_name']);
    echo '</pre>';
}

$read6 = $connect->query("SELECT * FROM users LIMIT 11,1");
foreach ($read6->fetchAll(PDO::FETCH_CLASS, \Source\Database\Entity\UserEntity::class) as $user){
    echo '<pre>';
    var_dump($user, $user->getFirstname());
    echo '</pre>';
}