<?php

function connect() {
    // conexao banco dados MySQL
    $host = 'localhost';
    $port = 3306;
    $base = 'moviesite';
    $user = 'luiscarlos';
    $pass = 'mother';


    @ $db = mysql_connect("$host:$port", $user, $pass);
    @ mysql_select_db($base, $db);

    if (!$db) {
        echo '<mark> Erro: Não foi possível conectar ao banco de dados. Por favor tente de novo mais tarde ou chame o administrador. </mark>';
        exit;
    }

    return $db;
}