<?php
require_once 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD)or die('Conecção não estabelecida. Verifique seus parametros de conecção.');
@ mysql_select_db(MYSQL_DB, $db)or die(mysql_error($db));

$id = (isset($_GET['id'])) ? $_GET['id'] : 0;
$token = (isset($_GET['token'])) ? $_GET['token'] : '';

$query = 'SELECT `email_id`, `token`, `to_name`, `to_email`, `from_name`, `from_email`, `subject`, `postcard`, `message` FROM'
        . '`pc_confirmation` WHERE'
        . '`token` = "' . $token . '"';
$result = mysql_query($query, $db)or die(mysql_error($db));

if (mysql_num_rows($result) == 0) {
    echo '<p>Ooops! Nada para confirmar.</p>';
    mysql_free_result($result);
    exit();
} else {
    $row = mysql_fetch_assoc($result);
    extract($row);
    mysql_free_result($result);
}

$boundary = '==MP_Bound_xyccr948x==';

$boundary = array();
$boundary[] = 'MIME-Version: 1.0';
$boundary[] = 'Content-type: multipart/alternative; boundary="' . $boundary . '"';
$boundary[] = 'From: ' . $from_email;

$postcard_message = '<html>';
$postcard_message .= '<p>Cumprimentos, ' . $to_name . '! ';
$postcard_message .= $from_name . 'Você enviou um cartão hoje.</p>';
$postcard_message .= '<p>Apreciar!</p>';
$postcard_message .= '<hr />';
$postcard_message .= '<img src="' . $postcard . '" alt="' . $description . '" /><br />';
$postcard_message .= $message;
$postcard_message .= '<hr /><p>Você pode tambem visitar <a href="http://localhost/NetBeans/PHP/comicbook_fansite/viewpostcard.php?id=' . $email_id . '&token=' . $token . '</a> para visualizar esse cartão postal online.</p></html>';

$mail_message = 'This is a Multipart Message in MIME format' . "\n";
$mail_message .= '__' . $boundary . "\n";
$mail_message .= 'Content-type: text/html; charset="UTF-8"' . "\n";
$mail_message .= 'Content-Transfer-Encoding: 7bit' . "\n\n";
$mail_message .= $postcard_message . "\n";
$mail_message .= '__' . $boundary . "\n";
$mail_message .= 'Content-Type: text/plain; charset="UTF-8"' . "\n";
$mail_message .= 'Content-Transfer-Encoding: 7bit' . "\n\n";
$mail_message .= strip_tags($postcard_message) . "\n";
$mail_message .= '__' . $boundary . '__' . "\n";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Enviando Cartão Postal!</title>
    </head>
    <body>
        <?php
        $success = mail($to_email, $subject, $mail_message, join("\r\n", $headers));
        if ($success) {
            echo '<h1>Parabens!</h1>';
            echo '<p>O seguinte cartão postal foi enviado para ' . $to_name . ':<br /></p>';
            echo $postcard_message;
        } else {
            echo '<p><strong>Houve um erro ao enviar sua mensagem.</strong></p>';
        }
        ?>
    </body>
</html>