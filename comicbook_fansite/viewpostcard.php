<?php
require_once 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida. Verifique seus parametros de conecção.');
@ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));

$id = (isset($_GET['id'])) ? $_GET['id'] : 0;
$token = (isset($_GET['token'])) ? $_GET['token'] : '';

$query = 'SELECT `email_id`, `token`, `to_name`, `from_name`, `from_email`, `subject`, `postcard`, `message` FROM'
        . '`pc_confirmation` WHERE token = "' . $token . '"';
$result = mysql_query($query, $db)or die(mysql_error($db));

if (mysql_num_rows($result) == 0) {
    echo '<p>Ooops! Nada para visualizar.</p>';
    mysql_free_result($result);
    exit();
} else {
    $row = mysql_fetch_assoc($result);
    extract($row);
    mysql_free_result($result);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $subject; ?></title>
    </head>
    <body>
        <?php
        echo '<img src="' . $postcard . '" alt="' . $description . '" /><br />';
        echo $message;
        ?>
    </body>
</html>