<?php

namespace www\PhpStudy\Integrating_PHP_Windows;
require_once './DatabaseConnection.php';
require_once './HTMLPage.php';

// Establish database connection
$db = new DatavaseConnection();
$db->connect();

// Query picture for product
$query = 'SELECT ThumbNailPhoto FROM Production.Product WHERE ProductID = ?';
$params = array((int) $_GET['id']);
$stmt = sqlsrv_query($db->handle, $query, $params);
if(!sqlsrv_fetch($stmt)){
    $db->exitWithError('The query of the photo has failed.');
}
// varbinary() is returned as stream with direct output
$stream = sqlsrv_get_field($stmt, 0);
header('Content-type: image/gif');
fpassthru($stream);
// Free statement; close database
sqlsrv_free_stmt($stmt);
$db->close();