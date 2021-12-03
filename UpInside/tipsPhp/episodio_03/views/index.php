<?php

require __DIR__ . '/../vendor/autoload.php';

use Source\Support\Email;

$email = new Email();

$subject = 'Olá Mundo Esse é o Meu Primeiro E-mail!';
$body = <<<corp
        <h1>Estou apenas testando!</h1>
            <p>Espero que tenha dado certo!!!</p>
corp;

$recipient_name = 'Luis Carlos';
$recipient_email = 'd.luiscarlos92@gmail.com';

$email->add($subject, $body, $recipient_name, $recipient_email)->send();

if (!$email->error()) {
    var_dump(true);
} else {
    echo $email->error()->getMessage();
}

$email->add($subject, $body, $recipient_name, $recipient_email
)->attach(
        "files/01.png",
        "FSPHP"
)->attach(
        "files/01.jpg",
        "LARADEV"
)->attach(
        "files/01.gif",
        "PHP"
)->send();

if (!$email->error()) {
    var_dump(true);
} else {
    echo $email->error()->getMessage();
}