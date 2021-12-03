<?php

require('exemplo1.php');

$id = '3';
$senha = 'Mudar123';
$senha = md5($senha);
$table = 'Usuarios';
$colum = 'Senha';

mysqli_query("UPDATE $table SET $colum='$senha' WHERE id_prf='$id'");