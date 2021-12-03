<?php

session_start();
require 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
@ mysql_select_db(MYSQL_DB, $db);

if (isset($_REQUEST['action'])) {
    switch ($_REQUEST['action']) {
        case 'Login':
            if (isset($_POST['email']) && isset($_POST['passwd'])) {
                $sql = 'SELECT'
                        . '`id`, `access_lvl`, `name`, `last_login` FROM'
                        . '`frm_users` WHERE'
                        . '`email` ="' . $_POST['email'] . '" AND'
                        . '`password` ="' . $_POST['passwd'] . '"';
                $result = mysql_query($sql, $db)or die(mysql_error($db));

                if ($row = mysql_fetch_array($result)) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['access_lvl'] = $row['access_lvl'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['last_login'] = $row['last_login'];

                    $sql = 'UPDATE `frm_users` SET'
                            . '`last_login` ="' . date('Y-m-d H:i:s') . '" WHERE'
                            . '`id` =' . $row['id'];
                    mysql_query($sql, $db)or die(mysql_error($db));
                }
            }
            header('Location: frm_index.php');
            exit();
            break;

        case 'Logout':
            session_unset();
            session_destroy();
            header('Location: frm_index.php');
            exit();
            break;

        case 'Create Account':
            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['passwd']) && isset($_POST['passwd2']) && $_POST['passwd'] == $_POST['passwd2']) {
                $sql = 'INSERT INTO `frm_users`'
                        . '(`email`, `name`, `password`, `date_joined`, `last_login`) VALUES'
                        . '("' . $_POST['email'] . '", "' . $_POST['name'] . '",'
                        . '"' . $_POST['passwd'] . '", "' . date('Y-m-d H:i:s') . '",'
                        . '"' . date('Y-m-d H:i:s') . '")';
                mysql_query($sql, $db)or die(mysql_error($db));

                $_SESSION['user_id'] = mysql_insert_id($db);
                $_SESSION['access_lvl'] = 1;
                $_SESSION['name'] = $_POST['name'];
                $_SESSION['login_time'] = date('Y-m-d H:i:s');
            }
            header('Location: frm_index.php');
            exit();
            break;

        case 'Modify Account':
            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['accesslvl']) && isset($_POST['userid'])) {
                $sql = 'UPDATE `frm_users` SET'
                        . '`email` ="' . $_POST['email'] . '",'
                        . '`name` ="' . $_POST['name'] . '",'
                        . '`access_lvl` ="' . $_POST['accesslvl'] . '",'
                        . '`signature` ="' . $_POST['signature'] . '" WHERE'
                        . '`id` =' . $_POST['id'];
                mysql_query($sql, $db)or die(mysql_error($db));
            }
            header('Location: frm_admin.php');
            exit();
            break;

        case 'Edit Account':
            if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['accesslvl']) && isset($_POST['userid'])) {
                $chg_pw = FALSE;
                if (!empty($_POST['oldpasswd'])) {
                    $sql = 'SELECT'
                            . '`passwd` FROM'
                            . '`frm_users` WHERE'
                            . '`id` =' . $_POST['userid'];
                    $result = mysql_query($sql, $db)or die(mysql_error($db));

                    if ($row = mysql_fetch_array($result)) {
                        if ($row['passwd'] == $_POST['oldpasswd'] && isset($_POST['passwd']) && isset($_POST['passwd2']) && $_POST['passwd'] == $_POST['passwd2']) {
                            $chg_pw = TRUE;
                        } else {
                            header('Location: frm_useraccount.php?error=nopassedit');
                            exit();
                            break;
                        }
                    }
                }
                $sql = 'UPDATE `frm_users` SET'
                        . '`email` ="' . $_POST['email'] . '",'
                        . '`name` ="' . $_POST['name'] . '",'
                        . '`access_lvl` ="' . $_POST['accesslvl'] . '",'
                        . '`signature` ="' . $_POST['signature'] . '"';

                if ($chg_pw) {
                    $sql .= "', `passwd` =" . $_POST['passwd'] . '"';
                }
                $sql .= 'WHERE `id` =' . $_POST['userid'];
                mysql_query($sql, $db)or die(mysql_error($db));
            }
            header('Location: frm_useraccount.php?blah=' . $_POST['userid']);
            break;

        case 'Send my reminder!':
            if (isset($_POST['email'])) {
                $sql = 'SELECT'
                        . '`password` FROM'
                        . '`frm_users` WHERE'
                        . '`email` ="' . $_POST['email'] . '"';
                $reult = mysql_query($sql, $db)or die(mysql_error($db));

                if (mysql_num_rows($result)) {
                    $row = mysql_fetch_array($result);

                    $headers = 'From: admin@yoursite.com' . "\r\n";
                    $subject = 'Comic site password reminder';
                    $body = 'Just a reminder, your password for the Comic Book Appreciation site is: ' . $row['passwd'] . "\n\n";
                    $body .= 'You can use this to log in at http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/frm_login.php?e=' . $_POST['email'];

                    mail($_POST['email'], $subject, $body, $headers);
                }
            }
            header('Location: frm_login.php');
            break;
    }
}