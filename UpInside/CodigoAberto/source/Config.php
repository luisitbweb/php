<?php

/**
 * SITE CONFIG
 */
define("SITE", [
    "name" => "Auth em MVC com PHP",
    "desc" => "Aprenda a construir uma aplicação de autenticação em MVC com PHP do Jeito certo!!!",
    "domain" => "serverweb.com",
    "locale" => "pt_BR",
    "root" => "https://serverweb/www/PHP/PHPStudy/UpInside/CodigoAberto"
]);

/**
 * SITE MINIFY
 */
if ($_SERVER["SERVER_NAME"] === "serverweb") {
    require __DIR__ . "/Minify.php";
}

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
 * SOCIAL CONFIG
 */define("SOCIAL", [
     "facebook_page" => "",
     "facebook_author" => "",
     "facebook_appId" => "46gf4h64gh6",
     "twitter_creator" => "",
     "twitter_site" => ""
 ]);
 
 /**
  * MAIL CONNECT
  */
 define("MAIL", [
     "host" => "smtp.sendgrid.net",
     "port" => "587",
     "user" => "apikey",
     "password" => "as6df46sd4f65d4f654asd6f465sad4f654asd65f46s5dfasdfasf",
     "from_name" => "Luis Carlos",
     "from_email" => "luiscarlosss2018@outlook.com"
 ]);
 
 /**
  * SOCIAL LOGIN: FACEBOOK
  */
 define("FACEBOOK_LOGIN", [
     "clientId" => "4654654654651465",
     "clientSecret" => "4f64gh5d6gv45fdg",
     "redirectUri" => SITE["root"] . "/facebook",
     "graphApiVersion" => "v4.0"
 ]);
 
 /**
  * SOCIAL LOGIN: GOOGLE
  */
 define("GOOGLE_LOGIN", [
     "clientId" => "465456-dfsfsdfsfsd5f464ad65f46sf.apps.googleusercontent.com",
     "clientSecret" => "46a4df654sd4fFGFDS5d5f4f",
     "redirectUri" => SITE["root"] . "/google"
 ]);