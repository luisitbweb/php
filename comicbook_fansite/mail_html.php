<?php

require_once 'Class.SimpleMail.php';

$message = new SimpleMail();

$message->setSendText(FALSE);
$message->setToAddress('seuemail@exemplo.com');
$message->setSubject('Testing HTML Email');
$message->setHMTLBody('<html><p>This is a test using <b>HTML email</b>!</p></html>');

if ($message->send()) {
    echo 'HTML email sent successfully!';
} else {
    echo 'Sending of HTML email failed!';
}