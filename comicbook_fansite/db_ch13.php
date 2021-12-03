<?php
require_once 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida.');
@ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));

$sql = 'CREATE TABLE IF NOT EXISTS cms_access_levels('
        . 'access_level TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,'
        . 'access_name VARCHAR(50) NOT NULL DEFAULT "",'
        . 'PRIMARY KEY (access_level))'
        . 'ENGINE=InnoDB';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'INSERT IGNORE INTO `cms_access_levels`'
        . '(`access_level`, `access_name`) VALUES'
        . '(1, "User"),'
        . '(2, "Moderator"),'
        . '(3, "Administrator")';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'CREATE TABLE IF NOT EXISTS cms_users('
        . 'user_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,'
        . 'email VARCHAR(100) NOT NULL UNIQUE,'
        . 'password CHAR(41) NOT NULL,'
        . 'name VARCHAR(100) NOT NULL,'
        . 'access_level TINYINT UNSIGNED NOT NULL DEFAULT 1,'
        . 'PRIMARY KEY(user_id))'
        . 'ENGINE=InnoDB';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'INSERT IGNORE INTO `cms_users`'
        . '(`user_id`, `email`, `password`, `name`, `access_level`) VALUES'
        . '(NULL, "admin@example.com", PASSWORD("secret"), "Administrator", 3),'
        . '(NULL, "luisitb@ig.com.br", PASSWORD("12345678"), "Administrator", 3)';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'CREATE TABLE IF NOT EXISTS cms_articles('
        . 'article_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,'
        . 'user_id INTEGER UNSIGNED NOT NULL,'
        . 'is_published BOOLEAN NOT NULL DEFAULT FALSE,'
        . 'submit_date DATETIME NOT NULL,'
        . 'publish_date DATETIME,'
        . 'title VARCHAR(255) NOT NULL,'
        . 'article_text MEDIUMTEXT,'
        . 'PRIMARY KEY(article_id),'
        . 'FOREIGN KEY(user_id) REFERENCES cms_users(user_id),'
        . 'INDEX (user_id, submit_date),'
        . 'FULLTEXT INDEX (title, article_text))'
        . 'ENGINE=InnoDB';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'CREATE TABLE IF NOT EXISTS cms_comments('
        . 'comment_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,'
        . 'article_id INTEGER UNSIGNED NOT NULL,'
        . 'user_id INTEGER UNSIGNED NOT NULL,'
        . 'comment_date DATETIME NOT NULL,'
        . 'comment_text MEDIUMTEXT,'
        . 'PRIMARY KEY(comment_id),'
        . 'FOREIGN KEY(article_id) REFERENCES cms_articles(article_id),'
        . 'FOREIGN KEY(user_id) REFERENCES cms_users(user_id))'
        . 'ENGINE=innoDB';
mysql_query($sql, $db)or die(mysql_error($db));

echo 'Sucesso FM !!!! Feito ok....';