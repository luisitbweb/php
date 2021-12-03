<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Source\Models\User;

$user = new User();
$user->id = 6;
$user->first_name = 'Fabiadfgsne';
$user->last_name = 'Leite dfg';
$user->genre = 'F';
$user->save();

var_dump($user);