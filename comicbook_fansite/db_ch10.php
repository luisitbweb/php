<?php

require_once 'db.inc.php';

 $db = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB) OR die('Conexão não estabelecida. Verifique seus parametros de conexão. <br />');

// cria banco de dados
/*
 * $query = 'CREATE DATABASE IF NOT EXISTS comicbook_fansite';
 * mysqli_query($query, $db) or die(mysqli_error($db));
 */

 mysqli_select_db(MYSQL_DB, $db) or die(mysqli_error($db));

// criar a tabela comic_caracter 
$query = 'CREATE TABLE IF NOT EXISTS comic_character('
        . 'character_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,'
        . 'alias VARCHAR(40) NOT NULL DEFAULT "",'
        . 'real_name VARCHAR(80) NOT NULL DEFAULT "",'
        . 'lair_id INTEGER UNSIGNED NOT NULL DEFAULT 0,'
        . 'alignment ENUM("good", "evil") NOT NULL DEFAULT "good",'
        . 'PRIMARY KEY (character_id))'
        . 'ENGINE=InnoDB';
mysqli_query($query, $db) or die(mysqli_error($db));

// criar a tabela comic_power
$query = 'CREATE TABLE IF NOT EXISTS comic_power('
        . 'power_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,'
        . 'power VARCHAR(40) NOT NULL DEFAULT "",'
        . 'PRIMARY KEY(power_id))'
        . 'ENGINE=InnoDB';
mysqli_query($query, $db) or die(mysqli_error($db));

// criar tabela comic_character_power ligada
$query = 'CREATE TABLE IF NOT EXISTS comic_character_power('
        . 'character_id INTEGER UNSIGNED NOT NULL DEFAULT 0,'
        . 'power_id INTEGER UNSIGNED NOT NULL DEFAULT 0,'
        . 'PRIMARY KEY (character_id, power_id))'
        . 'ENGINE=InnoDB';
mysqli_query($query, $db) or die(mysqli_error($db));

// criar tabela comic_lair 
$query = 'CREATE TABLE IF NOT EXISTS comic_lair('
        . 'lair_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,'
        . 'zipcode_id CHAR(9) NOT NULL DEFAULT "00000",'
        . 'address VARCHAR(40) NOT NULL DEFAULT "",'
        . 'PRIMARY KEY (lair_id))'
        . 'ENGINE=InnoDB';
mysqli_query($query, $db) or die(mysqli_error($db));

// criar tabela comic_zipcode
$query = 'CREATE TABLE IF NOT EXISTS comic_zipcode('
        . 'zipcode_id CHAR(9) NOT NULL DEFAULT "00000",'
        . 'city VARCHAR(40) NOT NULL DEFAULT "",'
        . 'state CHAR(2) NOT NULL DEFAULT "",'
        . 'PRIMARY KEY (zipcode_id))'
        . 'ENGINE=InnoDB';
mysqli_query($query, $db) or die(mysqli_error($db));

// criar tabela comic_rivalry
$query = 'CREATE TABLE IF NOT EXISTS comic_rivalry('
        . 'hero_id INTEGER UNSIGNED NOT NULL DEFAULT 0,'
        . 'villain_id INTEGER UNSIGNED NOT NULL DEFAULT 0,'
        . 'PRIMARY KEY (hero_id, villain_id))'
        . 'ENGINE=InnoDB';
mysqli_query($query, $db) or die(mysqli_error($db));

echo 'Feito.';