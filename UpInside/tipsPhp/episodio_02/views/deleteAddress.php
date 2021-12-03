<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Source\Models\Address;

$addr = (new Address())->findById(3);

if($addr){
    $addr->destroy();
}else{
    var_dump(addr);
}