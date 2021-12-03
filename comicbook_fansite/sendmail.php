<?php
$to_address = $_POST['to_address'];
$from_address = $_POST['from_address'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$boundary = '==MP_Bound_xyccr948x==';

//$headers = 'From: ' . $from_address . "\r\n";
$headers = array();
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: multipart/alternative; boundary="' . $boundary . '"';
$headers[] = 'Content-Transfer-Encoding: 7bit';
$headers[] = 'From: ' . $from_address;

$msg_body  = 'Essa e uma mensagem multipla no formato MIME.' . "\n";
$msg_body .= '__' . $boundary . "\n";
$msg_body .= 'Content-type: text/html; charset="UTF-8"' . "\n";
$msg_body .= 'Content-Transfer-Encoding: 7bit' . "\n\n";
$msg_body .= $message . "\n";
$msg_body .= '__' . $boundary . "\n";
$msg_body .= 'Content-type: text/plain; charset="UTF-8"' . "\n";
$msg_body .= 'Content-Transfer-Encoding: 7bit' . "\n\n";
$msg_body .= strip_tags($message) . "\n";
$msg_body .= '__' . $boundary . '__' . "\n";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Enviando E-mail</title>
    </head>
    <body>
        <?php
        $success = mail($to_address, $subject, $msg_body, join("\r\n", $headers));
        if ($success) {
            echo '<h1>Parabens!</h1>';
            echo '<p>A seguinte mensagem foi enviada:<br /><br />';
            echo '<b>Para:</b> ' . $to_address . '<br />';
            echo '<b>De:</b> ' . $from_address . '<br />';
            echo '<b>Assunto:</b> ' . $subject . '<br />';
            echo '<b>Mensagem:</b> ' . $message . '<br />';
            echo nl2br($message);
        } else {
            echo '<p><strong>Houve um erro ao enviar a sua mensagem.</strong></p>';
        }
        ?>
    </body>
</html>