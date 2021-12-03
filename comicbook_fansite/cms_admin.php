<?php
require_once 'db.inc.php';
include_once 'cms_header.inc.php';

echo '<hr>';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida!');
@ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));

$sql = 'SELECT'
        . '`access_level`, `access_name` FROM'
        . '`cms_access_levels` ORDER BY'
        . '`access_name` ASC';
$result = mysql_query($sql, $db)or die(mysql_error($db));

$privileges = array();
while ($row = mysql_fetch_assoc($result)){
    $privileges[$row['access_level']] = $row['access_name'];
}
mysql_free_result($result);

echo '<h2>Administração Usuario</h2>';

$limit = count($privileges);
for ($i = 1; $i <= $limit; $i++){
    echo '<h3>' . $privileges[$i] . '</h3>';
    
    $sql = 'SELECT'
            . '`user_id`, `name` FROM'
            . '`cms_users` WHERE'
            . '`access_level` ="' . $i . '"ORDER BY'
            . '`name` ASC';
    $result = mysql_query($sql, $db)or die(mysql_error($db));
    
    if (mysql_num_rows($result) == 0){
        echo '<p><strong>não há ' . $privileges[$i] . ' contas registradas</strong></p>';
    }  else {
        echo '<ul>';
        while ($row = mysql_fetch_assoc($result)){
            if (@ $_SESSION['user_id'] == $row['user_id']){
                echo '<li>' . htmlspecialchars($row['name']) . '</li>';
            }  else {
                echo '<li><a href="cms_user_account.php?user_id=' . $row['user_id'] . '">' . htmlspecialchars($row['name']) . '</a></li>';
            }
        }
        echo '</ul>';
    }
    mysql_free_result($result);
}
require_once 'cms_footer.inc.php';