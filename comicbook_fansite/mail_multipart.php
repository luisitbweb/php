<?php

require_once 'Class.SimpleMail.php';

$message = new SimpleMail();

$message->setToAddress('seuemail@exemplo.com');
$message->setFromAddress('meyemail@exemplo.com');
$message->setCCAddress('friend@exemplo.com');
$message->setBCCAddress('secret@exemplo.com');
$message->setSubject('Testing Multipart Email');
$message->setTextBody('This is the plain text portion of the email!');
$message->setHTMLBody('<html><p>This is the <b>HMTL portion</b> of the email!</p></html>');

if ($message->send()) {
    echo 'Multi-part mail sent seccessfully!';
} else {
    echo 'Sending the multi-part mail failed!';
}