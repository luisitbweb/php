<?php

$host = 'host=localhost';
$port = 'port=5432';
$user = 'user=admin';
$pass = 'password=4linux';
$base = 'dbname=projeto';

pg_connect("$host $port $base $user $pass");