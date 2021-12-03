<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Source\Models\User;

$user = (new User())->findById(3);

if($user){
    $user->destroy();
}else{
    var_dump($user);
}