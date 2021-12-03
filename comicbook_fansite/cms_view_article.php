<?php
require_once 'db.inc.php';
require_once 'cms_output_functions.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida.');
@ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));

include_once 'cms_header.inc.php';
output_story($db, $_GET['article_id']);
show_comments($db, $_GET['article_id'], TRUE);

include_once 'cms_footer.inc.php';