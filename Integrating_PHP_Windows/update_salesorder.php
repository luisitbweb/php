<?php

namespace www\PhpStudy\Integrating_PHP_Windows;
require_once './DatabaseConnection.php';
require_once './HTMLPage.php';
require_once './update_salesorder_db.php';

// Firmly defined for demonstration purposes
$updateOrderHeader = 71915;
$updateOrders = array(array(113089, 6, 0.10), array(113090, 1, 0.0),
                array(113091, 10, 0.20), array(113093, 3, 0.035));
$html = new HTMLPage('AdventureWords : Order Amount and Discount Correction');
$db = new DatabaseConnecton();
$db->connect();
$orders = new UpateOrders($db);

// Read and display data before update
$before = $orders->getByHeader($updateOrderHeader);
$html->addHTML('<div style="position:absolute; top:4em">');
$html->addElement('h2', 'Before Update');
$html->addTable($before);

// Prepare query and run multiple times
$orders->prepare();
foreach ($updateOrders as $order){
    list($id, $qty, $discount) = $order;
    $orders->update($id, $qty, $discount);
}
$orders->free();

// Read and display data after update
$after = $orders->getByHeader($updateOrderHeader);
$html->addHTML('</div><div style="position:absolute; top:4em; left: 15em">');
$html->addElement('h2', 'After update');
$html->addTable($after);
$html->addHTML('</div>');
$db->close();
$html->printPage();

/*
 * Specifying SQL Server data types for a parameterized query
 * 
 $query = 'SELECT ProductID, Name
FROM SalesLT.Product
WHERE ProductCategoryID = ? AND SellEndDate >= ? AND ListPrice <= ?';
$categoryID = 6;
$sellEnd = '2003-01-01';
$maxPrice = 799.90;
$params = array($categoryID,
array($sellEnd, null, null, SQLSRV_SQLTYPE_DATETIME),
array($maxPrice, null, null, SQLSRV_SQLTYPE_MONEY));
$stmt = sqlsrv_query($db, $query, $params);
 * 
 * Specifying the PHP data type when querying with sqlsrv_get_field().
 * 
 $query = 'SELECT ProductID, Weight, ListPrice, SellEndDate
FROM SalesLT.Product';
$stmt = sqlsrv_query($db, $query);
while (sqlsrv_fetch($stmt)) {
echo sqlsrv_get_field($stmt, 0, SQLSRV_PHPTYPE_INT), ' ',
sqlsrv_get_field($stmt, 1, SQLSRV_PHPTYPE_FLOAT), ' ',
sqlsrv_get_field($stmt, 2, SQLSRV_PHPTYPE_FLOAT), ' ',
sqlsrv_get_field($stmt, 3, SQLSRV_PHPTYPE_STRING(SQLSRV_ENC_CHAR)), "\n";
}
 */