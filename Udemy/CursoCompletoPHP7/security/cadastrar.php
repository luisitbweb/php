<?php

$email = $_POST['inputEmail'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
    'secret' => '6LcnDcQUAAAAANjAOfhbYIt0nPbGy236ZtDHN-h_',
    'response' => $_POST['g-recaptcha-response'],
    'remoteip' => $_SERVER['REMOTE_ADDR']
)));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

$recaptcha = json_decode(curl_exec($ch), TRUE);

curl_close($ch);

if($recaptcha['success'] === TRUE){
    echo 'OK <br />' . $_POST['inputEmail'];
}else{
    header("Location: exemplo-04.php");
}