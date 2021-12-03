<?php
require_once 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
@ mysql_select_db(MYSQL_DB, $db);

$sql = 'DELETE FROM `ml_subscriptions` WHERE `pending`= 1';
mysql_query($sql, $db)or die(mysql_error($db));

echo 'Registros deletados com Sucesso!';