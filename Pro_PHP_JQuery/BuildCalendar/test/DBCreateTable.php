<?php

declare (strict_types = 1);

require_once 'db.inc.php';

$mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);

 if ($mysqli->connect_errno){
     die('Conexão não estabelecida. Verifique seus parametros de conexão. <br /> (' 
             . $mysqli->mysqli_connect_errno . ")" 
             . $mysqli->connect_error);
 }

echo 'Conexão OK Success... ' . $mysqli->host_info . '<br />' . "\n";

/* Create Database */
if($mysqli->query("CREATE DATABASE IF NOT EXISTS `php-jquery_example` "
        . " DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;") === TRUE) {
printf("Database php-jquery_example Successsfully Created. \n <br />");
}else{
    die('Create Database Error <br /> (' . $mysqli->errno . ')' . $mysqli->error);
}

/* Create Table comic_caracter */
if ($mysqli->query("CREATE TABLE IF NOT EXISTS `php-jquery_example`.`events` "
        . "(`event_id` INT(11) NOT NULL AUTO_INCREMENT,"
        . "`event_title` VARCHAR(80) DEFAULT NULL,"
        . "`event_desc` TEXT,"
        . "`event_start` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00',"
        . "`event_end` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00', "
        . "PRIMARY KEY (`event_id`), "
        . "INDEX (`event_start`)) "
        . "ENGINE=InnoDB "
        . "CHARACTER SET utf8mb4 "
        . "COLLATE utf8mb4_unicode_ci;") === TRUE) {   
    printf("Table events Successfully Created.\n <br />");
} else {
    die('Create Table events Error <br /> (' . $mysqli->errno . ')' . $mysqli->error);
}

/* Insert Table events */
if ($mysqli->query("INSERT INTO `php-jquery_example`.`events`"
        . "(`event_title`, `event_desc`, `event_start`, `event_end`) "
        . " VALUES "
        . "('New Year&#039;s Day', 'Happy New Year!','2016-01-01 00:00:00', "
        . "'2016-01-01 23:59:59'), ('Last Day of January', "
        . "'Last day of the month! Yay!', '2016-01-31 00:00:00', "
        . "'2016-01-31 23:59:59')") === TRUE) {         
    printf("Insert Data Successfully.\n <br />");
} else {
    die('Insert Data Table events Error <br /> (' . $mysqli->errno . ') ' . $mysqli->error);
}

/* Create Table users */
if($mysqli->query("CREATE TABLE IF NOT EXISTS `php-jquery_example`.`users` ( "
        . "`user_id` INT(11) NOT NULL AUTO_INCREMENT, "
        . "`user_name` VARCHAR(80) DEFAULT NULL, "
        . "`user_pass` VARCHAR(47) DEFAULT NULL, "
        . "`user_email` VARCHAR(80) DEFAULT NULL, "
        . "PRIMARY KEY (`user_id`), UNIQUE (`user_name`)) "
        . "ENGINE=MyISAM CHARACTER SET utf8mb4 COLLATE  utf8mb4_unicode_ci;") === TRUE){
    printf("Create Table users Successfully Created.\n <br />");
}else{
    die('Create Table users Error <br /> (' . $mysqli->errno . ')' . $mysqli->error);
}

/* Insert Table users */
if($mysqli->query("INSERT INTO `php-jquery_example`.`users` "
        . "(`user_name`, `user_pass`, `user_email`) "
        . "VALUES "
        . "('testuser', 'a1645e41f29c45c46539192fe29627751e1838f7311eeb4', "
        . "'admin@example.com');") === TRUE){
printf("Insert Data Table users Successfully.\n <br />");
}else{
    die('Insert Data Table users Error <br /> (' . $mysqli->errno . ') ' . $mysqli->error);
}

echo 'Feito!!!';

$mysqli->close();
exit();