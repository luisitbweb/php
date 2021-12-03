<?php
require_once 'db.inc.php';
require_once 'cms_output_functions.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida!');
@ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));

include_once 'cms_header.inc.php';

$sql = 'SELECT `article_id` FROM'
        . '`cms_articles` WHERE'
        . '`is_published` = TRUE ORDER BY'
        . '`publish_date` DESC';
$result = mysql_query($sql, $db)or die(mysql_error($db));

if (mysql_num_rows($result) == 0){
    echo '<p><strong>Atualmente não há artigos para visualizar.</strong></p>';
}  else {
    while ($row = mysql_fetch_array($result)){
        output_story($db, $row['article_id'], TRUE);
    }
}
mysql_free_result($result);

include_once 'cms_footer.inc.php';