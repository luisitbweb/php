<?php

declare (strict_types=1);

/*
 * Enable sessions if needed.
 * Avoid pesky warning if session already active.
 */

$status = session_status();
if ($status == PHP_SESSION_NONE) {
    // There is no active session
    session_start();
}

/*
 * Include the necessary configuration info
 */
include_once '../../../sys/config/db-cred.inc.php';

/*
 * Define constants for config info
 */
foreach ($C as $name => $val) {
    define($name, $val);
}

/*
 * Create a lookup array for form actions
 */
define('ACTIONS', array(
    'event_edit' => array(
        'object' => 'Calendar',
        'method' => 'processForm',
        'header' => 'Location: ../../'
    ),
    'user_login' => array(
        'object' => 'Admin',
        'method' => 'processLoginForm',
        'header' => 'Location: ../../'
    ),
    'user_logout' => array(
         'object' => 'Admin',
         'method' => 'processLogout',
         'header' => 'Location: ../../'
        )
    )
);

/*
 * Create a PDO object.
 */
$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
$dbo = new PDO($dsn, DB_USER, DB_PASS);

/*
 * Make sure the anti-CSRF token was passed and that the
 * requested action exists in the lookup array
 */
if ($_POST['token'] == $_SESSION['token'] && isset(ACTIONS[$_POST['action']])) {
    $use_array = ACTIONS[$_POST['action']];
    $obj = new $use_array['object']($dbo);
    $method = $use_array['method'];
    if (TRUE === $msg = $obj->$method()) {
        header($use_array['header']);
        exit;
    } else {
        // If an error occured, output it and end execution
        die($msg);
    }
} else {
    // Redirect to the main index if the token/action is invalid
    header("Location: ../../");
    exit;
}

/*
 * Define the auto-load function for classes
 *
spl_autoload_register(function($class_name) {
    $dirClass = '../../../sys/class/class.';
    $filename = $dirClass . strtolower($class_name) . '.inc.php';
    if (file_exists($filename)) {
        include_once $filename;
    }
});
 * 
 */

function __autoload($class_name){
    
    $filename = '../../../sys/class/class.' 
            . strtolower($class_name) . '.inc.php';
    //echo "INFO: process.inc.php: autoload: " . $filename . "<br />";
    if ( file_exists($filename) ){
        
        include_once $filename;
    }
}