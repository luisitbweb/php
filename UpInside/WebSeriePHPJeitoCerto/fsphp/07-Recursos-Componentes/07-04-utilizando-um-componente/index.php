<?php
require __DIR__ . '/../../fullstackphp/fsphp.php';
fullStackPHPClassName("07.04 - Utilizando um componente");

require __DIR__ . "/source/autoload.php";

/*
 * [ instance ] https://packagist.org/packages/phpmailer/phpmailer
 */
fullStackPHPClassSession("instance", __LINE__);

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception as MailException;
//
//$phpMailer = new PHPMailer();
//var_dump($phpMailer instanceof PHPMailer);

/*
 * [ configure ]
 */
fullStackPHPClassSession("configure", __LINE__);

try {
    $mail = new PHPMailer(true);

    // config
    $mail->isSMTP();
    $mail->setLanguage("br");
    $mail->isHTML(true);
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->CharSet = 'utf-8';

    // auth
    $mail->Host = "smtp.sendgrid.net";
    $mail->Username = "apikey";
    $mail->Password = "164654654654";
    $mail->Port = "587";

    // mail
    $mail->setFrom("cursos@upinside.com.br", "Luis Carlos");
    $mail->Subject = "Este é meu envio via componente no FSPHP";
    $mail->msgHTML("<h1>Olá mundo!!!</h1><p>Esse é meu primeiro disparo de e-mail.</p>");

    // send
    $mail->addAddress("luisitb@ig.com.br", "Luis Carlos");
    $send = $mail->send();

} catch (Exception $excepiton) {
    echo message()->error($exception->getMessage());
}