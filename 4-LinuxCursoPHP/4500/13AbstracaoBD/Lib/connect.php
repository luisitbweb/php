<?php
/* PG
$host = 'host=localhost';
$port = 'port=5432';
$base = 'dbname=projeto';
$user = 'user=admin';
$pass = 'password=4linux';
*/
//pg_connect("$host $port $base $user $pass");

//MySQL
$host = 'localhost';
$port = 3306;
$base = 'projeto';
$user = 'admin';
$pass = '4linux';


@ mysql_connect("$host:$port",$user, $pass);
mysql_select_db( $base );