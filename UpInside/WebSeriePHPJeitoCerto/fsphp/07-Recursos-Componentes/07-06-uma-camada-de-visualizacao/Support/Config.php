<?php

/**
 * Database
 */

define("CONF_DB_HOST", "localhost");
define("CONF_DB_USER", "luisitb");
define("CONF_DB_PASS", '$tr@wb3rry');
define("CONF_DB_NAME", "fullstackphp");

/**
 * Project URLs
 */
define("CONF_URL_BASE", "https://www.localhost/fsphp");
define("CONF_URL_ADMIN", CONF_URL_BASE ."/admin");
define("CONF_URL_ERROR", CONF_URL_BASE ."/404");

/**
 * Dates
 */
define("CONF_DATE_BR", "d-m-Y H:i:s");
define("CONF_DATE_APP", "Y-m-d H:i:s");

/**
 * session
 */
define("CONF_SES_PATH", __DIR__ . "../../storage/sessions/");

/**
 * Password
 */
define("CONF_PASSWD_MIN_LEN", 8);
define("CONF_PASSWD_MAX_LEN", 40);
define("CONF_PASSWD_ALGO", PASSWORD_DEFAULT);
define("CONF_PASSWD_OPTION",["cost" => 10]);

/**
 * MESSAGE
 */
define("CONF_MESSAGE_CLASS", "trigger");
define("CONF_MESSAGE_INFO", "info");
define("CONF_MESSAGE_SUCCESS", "success");
define("CONF_MESSAGE_WARNING", "warning");
define("CONF_MESSAGE_ERROR", "error");

/**
 * View
 */
define("CONF_VIEW_PATH", __DIR__ . "/assets/views");
define("CONF_VIEW_EXT", "php");

/**
 * MAIL
 */
define("CONF_MAIL_HOST", "smtp.sendgrid.net");
define("CONF_MAIL_PORT", "587");
define("CONF_MAIL_USER", "apikey");
define("CONF_MAIL_PASS", "5646546sd5fg46sd4g6sdf4sd6");
define("CONF_MAIL_SENDER", ["name" => "Luis Carlos",
    "address" => "cursos@upinside.com.br"]);
define("CONF_MAIL_OPTION_LANG", "br");
define("CONF_MAIL_OPTION_HTML", true);
define("CONF_MAIL_OPTION_AUTH", true);
define("CONF_MAIL_OPTION_SECURE", "tls");
define("CONF_MAIL_OPTION_CHARSET", "utf-8");