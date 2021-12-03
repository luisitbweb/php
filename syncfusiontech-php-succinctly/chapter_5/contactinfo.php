<?php

$dbhost = 'localhost';
$dbuser = 'luisitb';
$dbpass = '$tr@wb3rry';
$database = 'contactinfo';

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $database);

if($mysqli->connect_errno){
    echo "We're sorry, The website can not connect to the database";
    echo "Error: MySQL connection failed: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";

    exit;
}
echo 'MySql connection succeeded';
$mysqli->close();