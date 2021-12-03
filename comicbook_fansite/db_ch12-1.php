<?php
require_once 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida.');
@ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));

// criar a tabela de usuario
$query = 'CREATE TABLE IF NOT EXISTS  site_user('
        . 'user_id INTEGER NOT NULL AUTO_INCREMENT,'
        . 'username VARCHAR(20) NOT NULL,'
        . 'password CHAR(41) NOT NULL,'
        . 'PRIMARY KEY(user_id))'
        . 'ENGINE=InnoDB';
mysql_query($query, $db)or die(mysql_error($db));

// criar a tabela de informacao usuario 
$query = 'CREATE TABLE IF NOT EXISTS site_user_info('
        . 'user_id INTEGER NOT NULL,'
        . 'first_name VARCHAR(20) NOT NULL,'
        . 'last_name VARCHAR(20) NOT NULL,'
        . 'email VARCHAR(50) NOT NULL,'
        . 'city VARCHAR(20),'
        . 'state CHAR(2),'
        . 'hobbies VARCHAR(255),'
        . 'FOREIGN KEY(user_id) REFERENCES site_user(user_id))'
        . 'ENGINE=InnoDB';
mysql_query($query, $db)or die(mysql_error($db));

// povoar tabela usuario
$query = 'INSERT IGNORE INTO `site_user`'
        . '(`user_id`, `username`, `password`) VALUES'
        . '(1, "john", PASSWORD("secret")),'
        . '(2, "sally", PASSWORD("password"))';
mysql_query($query, $db)or die(mysql_error($db));

// povoar tabela de informacoes do usuario
$query = 'INSERT IGNORE INTO `site_user_info`'
        . '(`user_id`, `first_name`, `last_name`, `email`, `city`, `state`, `hobbies`) VALUES'
        . '(1, "john", "doe", "jdoe@example.com", NULL, NULL, NULL),'
        . '(2, "sally", "smith", "ssmith@example.com", NULL, NULL, NULL)';
mysql_query($query, $db)or die(mysql_error($db));

echo 'Sucesso!!!! FM';