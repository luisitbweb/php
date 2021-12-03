<?php

require 'db.inc.php';

@ $db = mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD);
@ mysql_select_db(MYSQL_DB, $db);

session_start();
$session = session_id();

$qty = (isset($_POST['qty']) && ctype_digit($_POST['qty'])) ? $_POST['qty'] : 0;
$product_code = (isset($_POST['product_code'])) ? $_POST['product_code'] : '';
$action = (isset($_POST['submit'])) ? $_POST['submit'] : '';
$redirect = (isset($_POST['redirect'])) ? $_POST['redirect'] : 'ecomm.shop.php';

switch ($action) {
    case 'Add to Cart':
        if (!empty($product_code) && $qty > 0) {
            $query = 'INSERT INTO `ecomm_temp_cart`'
                    . '(`session`, `product_code`, `qty`) VALUES'
                    . '("' . $session . '", "' . mysql_real_escape_string($product_code, $db) . '", "' . $qty . '")';
            mysql_query($query, $db)or die(mysql_error($db));
        }
        header('Location: ' . $redirect);
        exit();
        break;

    case 'Change Qty':
        if (!empty($product_code)) {
            if ($qty > 0) {
                $query = 'UPDATE `ecomm_temp_cart` SET'
                        . '`qty` ="' . $qty . '" WHERE'
                        . '`session` ="' . $session . '" AND'
                        . '`product_code` ="' . mysql_real_escape_string($product_code, $db) . '"';
            } else {
                $query = 'DELETE FROM `ecomm_temp_cart`'
                        . 'WHERE `session` ="' . $session . '" AND'
                        . '`product_code` ="' . mysql_real_escape_string($product_code, $db) . '"';
            }
            mysql_query($query, $db)or die(mysql_error($db));
        }
        header('Location: ' . $redirect);
        exit();
        break;

    case 'Empty Cart':
        $query = 'DELETE FROM `ecomm_temp_cart`'
                . 'WHERE `session` ="' . $session . '"';
        mysql_query($query, $db)or die(mysql_error($db));
        header('Location: ' . $redirect);
        exit();
        break;
}