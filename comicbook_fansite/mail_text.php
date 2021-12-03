<?php

require_once 'Class.SimpleMail.php';

$message = new SimpleMail();

$message->setToAddress('seuemail@exemplo.com');
$message->setSubject('Testing text email');
$message->setTextBody('This is a test using plain text email!');

if ($message->send()) {
    echo 'Text email sent successfully!';
} else {
    echo 'Sending of text email failed!';
}