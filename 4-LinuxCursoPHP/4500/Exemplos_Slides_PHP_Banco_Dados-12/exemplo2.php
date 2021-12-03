<?php

require('exemplo1.php');

$user = 'aluno.501@4linux.com.br';
$pass = '4linux';
$pass = hash('md5',$pass);

mysqli_query('INSERT INTO Usuarios(Login,Senha)VALUES("$user","$pass")');