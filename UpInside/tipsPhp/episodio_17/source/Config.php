<?php
/**
 * ROOT URL
 */
define("ROOT", "https://serverweblocal/www/PHP/PHPStudy/UpInside/tipsPhp/episodio_17");

/**
 * CONFIG DATABASE
 */
define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "db_datalayer",
    "username" => "luisitb",
    "passwd" => '$tr@wb3rry',
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

/**
 * PAGARME_API_KEY
 */
define("PAGARME_API_KEY", "ak_test_");

/**
 * @param $path
 * @return string
 */
function asset($path): string
{
    return ROOT . "/views/assets{$path}";
}