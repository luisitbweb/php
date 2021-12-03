<?php

require_once 'Class.SimpleMail.php';

$message = new SimpleMail();

if ($message->send('seuemail@exemplo.com', 'Testing quick email', 'This is a quick test of SimpleMail->send().')) {
    echo 'Quick mail sent successfully!';
} else {
    echo 'Sending the quick mail failed!';
}