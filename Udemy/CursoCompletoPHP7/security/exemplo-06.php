<?php

// para PHP 7.0 e anterior

$data = [
    "nome" => "Hcode"
];

define('SECRET', pack('a16', 'senha'));

$mcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, SECRET, json_encode($data), 
        MCRYPT_MODE_CBC);

$final = base64_encode($mcrypt);

var_dump($final);

$string = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, SECRET, base64_decode($final), 
        MCRYPT_MODE_CBC);

var_dump($string);