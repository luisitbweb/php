<?php
require_once 'db.inc.php';
@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
@ mysql_select_db(MYSQL_DB, $db);

$sql = 'SELECT * FROM `frm_admin`';
$result = mysql_query($sql, $db)or die(mysql_error($db));

while ($row = mysql_fetch_array($result)){
    $admin[$row['constant']]['title'] = $row['title'];
    $admin[$row['constant']]['value'] = $row['value'];
}
mysql_free_result($result);

$sql = 'SELECT * FROM `frm_bbcode`';
$result = mysql_query($sql, $db)or die(mysql_error($db));

while ($row = mysql_fetch_array($result)){
    $bbcode[$row['id']]['template'] = $row['template'];
    $bbcode[$row['id']]['replacement'] = $row['replacement'];
}
mysql_free_result($result);

define('NEWPOST', '&raquo;');
define('POSTLINK', '&diams;');