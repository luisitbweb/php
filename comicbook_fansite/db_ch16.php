<?php
require 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida');
@ mysql_select_db(MYSQL_DB, $db);

$sql = 'CREATE TABLE IF NOT EXISTS frm_access_levels('
        . 'access_lvl TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,'
        . 'access_name VARCHAR(50) NOT NULL,'
        . 'PRIMARY KEY(access_lvl))'
        . 'ENGINE=InnoDB';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'INSERT IGNORE INTO `frm_access_levels`'
        . '(`access_lvl`, `access_name`) VALUES'
        . '(1, "User"),'
        . '(2, "Moderator"),'
        . '(3, "Administrator")';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'CREATE TABLE IF NOT EXISTS frm_admin('
        . 'id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,'
        . 'title VARCHAR(100) NOT NULL DEFAULT "",'
        . 'value VARCHAR(255) NOT NULL DEFAULT "",'
        . 'constant VARCHAR(100) NOT NULL DEFAULT "",'
        . 'PRIMARY KEY(id))'
        . 'ENGINE=InnoDB';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'INSERT IGNORE INTO `frm_admin`'
        . '(`id`, `title`, `value`, `constant`) VALUES'
        . '(NULL, "Board Title", "Comic Book Appreciation Forums", "Title"),'
        . '(NULL, "Board Description", "The Place to Discuss Your Favarite Comic Books, Movies and More!", "Description"),'
        . '(NULL, "Admin Email", "admin@example.com", "admin_email"),'
        . '(NULL, "Copyright", "&copy; Comic Book Appreciation, Inc. All Rights Reserved.", "Copyright"),'
        . '(NULL, "Board Titlebar", "CBA Forums", "Titlebar"),'
        . '(NULL, "Pagination Limit", "10", "PageLimit"),'
        . '(NULL, "Pagination Range", "7", "PageRange")';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'CREATE TABLE IF NOT EXISTS frm_bbcode('
        . 'id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,'
        . 'template VARCHAR(255) NOT NULL DEFAULT "",'
        . 'replacement VARCHAR(255) NOT NULL DEFAULT "",'
        . 'PRIMARY KEY(id))'
        . 'ENGINE=InnoDB';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'CREATE TABLE IF NOT EXISTS frm_forum('
        . 'id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,'
        . 'forum_name VARCHAR(100) NOT NULL DEFAULT "",'
        . 'forum_desc VARCHAR(255) NOT NULL DEFAULT "",'
        . 'forum_moderator INTEGER UNSIGNED NOT NULL DEFAULT 0,'
        . 'PRIMARY KEY(id))'
        . 'ENGINE=InnoDB';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'INSERT IGNORE INTO `frm_forum`'
        . '(`id`, `forum_name`, `forum_desc`, `forum_moderator`) VALUES'
        . '(NULL, "New Forum", "This is the initial forum created when installing the database. Change the name and the description after installation.", 1)';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'CREATE TABLE IF NOT EXISTS frm_post_count('
        . 'user_id INTEGER UNSIGNED NOT NULL DEFAULT 0,'
        . 'post_count INTEGER UNSIGNED NOT NULL DEFAULT 0,'
        . 'PRIMARY KEY(user_id))'
        . 'ENGINE=InnoDB';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'INSERT INTO `frm_post_count` VALUES (1, 1)';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'CREATE TABLE IF NOT EXISTS frm_posts('
        . 'id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,'
        . 'topic_id INTEGER UNSIGNED NOT NULL DEFAULT 0,'
        . 'forum_id INTEGER UNSIGNED NOT NULL DEFAULT 0,'
        . 'author_id INTEGER UNSIGNED NOT NULL DEFAULT 0,'
        . 'update_id INTEGER UNSIGNED NOT NULL DEFAULT 0,'
        . 'date_posted DATETIME NOT NULL DEFAULT "0000-00-00 00:00:00",'
        . 'date_updated DATETIME,'
        . 'subject VARCHAR(100) NOT NULL DEFAULT "",'
        . 'body MEDIUMTEXT,'
        . 'PRIMARY KEY(id), INDEX(forum_id, topic_id, author_id, date_posted),'
        . 'FULLTEXT INDEX(subject, body))'
        . 'ENGINE=InnoDB';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'INSERT IGNORE INTO `frm_posts`'
        . '(`id`, `topic_id`, `forum_id`, `author_id`, `update_id`, `date_posted`, `date_updated`, `subject`, `body`) VALUES'
        . '(1, 0, 1, 1, 0, "' . date('Y-m-d H:i:s') . '", 0, "Welcome", "Welcome to your new Bulletin Board System. Do not forget to change your admin password after installation. Have fun!")';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'CREATE TABLE IF NOT EXISTS frm_users('
        . 'id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,'
        . 'email VARCHAR(100) NOT NULL UNIQUE,'
        . 'password CHAR(41) NOT NULL,'
        . 'name VARCHAR(100) NOT NULL,'
        . 'access_lvl TINYINT UNSIGNED NOT NULL DEFAULT 1,'
        . 'signature VARCHAR(255),'
        . 'date_joined DATETIME NOT NULL,'
        . 'last_login DATETIME,'
        . 'PRIMARY KEY(id))'
        . 'ENGINE=InnoDB';
mysql_query($sql, $db)or die(mysql_error($db));

$sql = 'INSERT IGNORE INTO `frm_users`'
        . '(`id`, `name`, `email`, `password`, `access_lvl`, `signature`, `date_joined`, `last_login`) VALUES'
        . '(1, "Administrator", "admin@example.com", PASSWORD("secret"), 3, "", "' . date('Y-m-d H:i:s') . '", NULL)';
mysql_query($sql, $db)or die(mysql_error($db));

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Criando Tabelas Forum</title>
    </head>
    <body>
        <h1>Forum Apreciação livro quadrinhos</h1>
        <p>O seguinte forum teve as tabelas criadas:</p>
        <ul>
            <li>frm_access_levels</li>
            <li>frm_admin</li>
            <li>frm_bbcode</li>
            <li>frm_from</li>
            <li>frm_post</li>
            <li>frm_posts</li>
            <li>frm_users</li>
        </ul>
        <p><a href="frm_login.php">Logar</a> no site agora.</p>
    </body>
</html>