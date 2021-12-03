<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Source\Models\Address;

$addr = (new Address())->findById(2);

$addr->street = 'Paulo Roberto';
$addr->save();

var_dump($addr);