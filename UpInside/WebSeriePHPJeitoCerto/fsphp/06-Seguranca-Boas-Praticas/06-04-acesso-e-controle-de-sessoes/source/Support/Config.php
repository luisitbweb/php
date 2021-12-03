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
