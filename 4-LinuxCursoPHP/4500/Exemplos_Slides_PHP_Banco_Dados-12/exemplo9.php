<?php

require('exemplo6.php');

$id = '4';
$senha = 'Mudar123';
$senha = md5($senha);
$table = 'Usuarios';
$colum = 'Senha';

pg_query("UPDATE $table SET $colum='$senha' WHERE id_prf='$id'");