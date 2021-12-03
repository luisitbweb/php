<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
    'db' => [
        'driver' => 'Pdo',
        'dsn'    => sprintf('sqlite:%s/zftutorial.db', realpath(getcwd())),
    ],
];
/*
 *
$dbhost = 'localhost';
$dbuser = 'luisitb';
$dbpass = '$tr@wb3rry';
$database = 'zafutorial';

$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $database);

if($mysqli->connect_errno){
    echo "We're sorry, The website can not connect to the database ";
    echo "Error: MySQL connection failed: \n";
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";

    exit;
}

$mysqli->close();
 *
 */