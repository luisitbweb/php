<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Source\Models\User;
use Source\Models\Address;

$user = new User();
$addr = new Address();

$addr->add($user, 'Paulo roberto', '5854r');
$addr->save();

var_dump($user, $addr);