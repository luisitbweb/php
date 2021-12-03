<?php
require_once 'db.inc.php';
@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida. Verifique seus parametros de conecção.');
@ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));

$to_name = $_POST['to_name'];
$to_email = $_POST['to_email'];
$from_name = $_POST['from_name'];
$from_email = $_POST['from_email'];
$postcard = $_POST['postcard'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$query = 'SELECT `description` FROM `pc_image` WHERE image_url="' . $postcard . '"';
$result = mysql_query($query, $db)or die(mysql_error($db));

$description = '';

if (mysql_num_rows($result)) {
    $row = mysql_fetch_assoc($result);
    $description = $row['description'];
}

mysql_free_result($result);
$token = md5(time());

$query = 'INSERT INTO `pc_confirmation`'
        . '(`email_id`, `token`, `to_name`, `to_email`, `from_name`, `from_email`, `subject`, `postcard`, `message`) VALUES'
        . '(NULL, "' . $token . '", "' . $to_name . '", "' . $to_email . '", "' . $from_name . '", "' . $from_email . '", "' . $subject . '", "' . $postcard . '", "' . $message . '")';

mysql_query($query, $db)or die(mysql_error($db));
$email_id = mysql_insert_id($db);

$headers = array();
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset="UTF-8"';
$headers[] = 'Content-Transfer-Encoding: 7bit;';
$headers[] = 'From: no-reply@localhost';

$confirm_subject = 'Por favor confirmar seu cartão postal [' . $subject . ']';

$confirm_message = '<html>';
$confirm_message .= '<p>Hello, ' . $from_name . '. Por favor click no link abaixo para confirmar que você gostaria de enviar este cartão.</p>';
$confirm_message .= '<p><a href="http://localhost/NetBeans/PHP/comicbook_fansite/confirm.php?id=' . $email_id . '&token=' . $token . '">Click aqui para confirmar</a></p>';
$confirm_message .= '<hr />';
$confirm_message .= '<img src="' . $postcard . '" alt="' . $description . '" /><br />';
$confirm_message .= $message . '</html>';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Enviando E-mail!</title>
    </head>
    <body>
        <?php
        $success = mail($from_email, $confirm_subject, $confirm_message, join("\r\n", $headers));

        if ($success) {
            echo '<h1>Confirmação Pendente!</h1>';
            echo '<p>Uma confirmação e-mail foi enviada para ' . $from_email . '. Abrir seu e-mail e clicar no link para confirmar que você gostaria de enviar este cartão para ' . $to_name . '.</p>';
        }
        ?>
    </body>
</html>