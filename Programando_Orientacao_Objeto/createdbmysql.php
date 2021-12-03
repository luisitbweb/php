<?php
require_once '../../comicbook_fansite/db.inc.php';
@ $con = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);

$query = 'CREATE DATABASE livro';

@ $db = mysql_select_db('livro');

$query = 'CREATE TABLE famosos('
        . 'codigo INTEGER AUTO_INCREMENT,'
        . 'nome VARCHAR(40),'
        . 'PRIMARY KEY(codigo))'
        . 'ENGINE=InnoDB';


echo 'banco e tabela criados com sucesso!!!';