<?php
session_start();
require 'db.inc.php';
require 'frm_output_functions.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
@ mysql_select_db(MYSQL_DB, $db);

require 'frm_config.inc.php';

$title = $admin['Titlebar']['value'];

if (isset($pageTitle) and $pageTitle != '') {
    $title .= ' :: ' . $pageTitle;
}
if (isset($_SESSION['user_id'])) {
    $userid = $_SESSION['user_id'];
} else {
    $userid = NULL;
}
if (isset($_SESSION['access_lvl'])) {
    $access_lvl = $_SESSION['access_lvl'];
} else {
    $access_lvl = NULL;
}
if (isset($_SESSION['name'])) {
    $username = $_SESSION['name'];
} else {
    $username = NULL;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
        <style type="text/css">
            th{background-color: #999;}
            td{vertical-align: top;}
            .odd_row{background-color: #EEE;}
            .even_row{background-color: #FFF;}
        </style>
    </head>
    <body>
        <h1><?php echo $admin['Title']['value']; ?></h1>
        <h2><?php echo $admin['Description']['value']; ?></h2>
        <?php
        if (isset($_SESSION['name'])) {
            echo '<p>Welcome, "' . $_SESSION['name'] . '"</p>';
        }
        ?>
        <form method="get" action="frm_search.php">
            <div>
                <input type="text" name="keywords"
                <?php
                if (isset($_GET['keywords'])) {
                    echo 'value="' . htmlspecialchars($_GET['keywords']) . '" ';
                }
                ?>
                       />
                <input type="submit" value="Search" />
            </div>
        </form>
        <?php
        echo '<p><a href="frm_index.php">Home</a>';
        if (!isset($_SESSION['user_id'])) {
            echo ' | <a href="frm_login.php">Log In</a>';
            echo ' | <a href="frm_useraccount.php">Register</a>';
        } else {
            echo ' | <a href="frm_transact_user.php?action=Logout">';
            echo 'Log out ' . $_SESSION['name'] . '</a>';
            if ($_SESSION['access_lvl'] > 2) {
                echo ' | <a href="frm_admin.php">Admin</a>';
            }
            echo ' | <a href="frm_useraccount.php">Profile</a>';
        }
        echo '</p>';