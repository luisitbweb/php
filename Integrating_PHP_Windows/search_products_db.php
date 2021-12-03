<?php

namespace www\PhpStudy\Integrating_PHP_Windows;

/*
 * Query of all products whose name starts with $name.
 * @return array Data for the HTML table
 */

function getProductsByName($name) {
    $db = new DatabaseConnection();
    $db->connect();

    // Select products by name and list price
    $query = 'SELECT ProductID, Name, ListPrice'
            . 'FROM Production.Product WHERE Name LIKE ?'
            . 'ORDER BY Name';
    $params = array($name . '%');

    // Run query
    $stmt = sqlsrv_query($db->handle, $query, $params);

    if ($stmt === FALSE) {
        $db->exitWithError('Product data query failed.');
    }
    if (!sqlsrv_has_rows($stmt)) {
        return FALSE; // no hits in the database (empty result)
    }
    // Retrieve individual rows from the result
    $table = array(array('ID', 'Product', 'List Price'));

    while ($row = sqlsrv_fetch_array($stmt)) {
        $table[] = array($row['ProductID'], $row['Name'], $row['ListPrice']);
    }

    // null == no more rows, false == error
    if ($row === FALSE) {
        $db->exitWithError('Retrieving product data entry failed.');
    }
    sqlsrv_free_stmt($stmt);
    $db->close();
    return $table;
}

// querying data by using the sqlsrv_fetch_object()
$stmt = sqlsrv_query($db, 'SELECT DISTINCT TOP(10) FirstName, LastName, EmailAddress '
        . 'FROM Sales.Customer ORDER BY LastName, FirstName');
while ($obj = sqlsrv_fetch_object($stmt)) {
    printf("<li>%s %s &lt; %s &gt;</li> \n", htmlspecialchars($obj->FirstName), htmlspecialchars($obj->LastName), htmlspecialchars($obj->EmailAddress));
}
sqlsrv_free_stmt($stmt);

// instantiating a certain class by using the sqlsrv_fetch_object()
class Customer {

    function printData() {
        printf("<li>%s %s &lt;%s&gt;</li>\n", htmlspecialchars($obj->FirstName), htmlspecialchars($obj->LastName), htmlspecialchars($obj->EmailAddress));
    }

}

$stmt = sqlsrv_query($db, 'SELECT DISTINCT TOP(10) FirstName, LastName, EmailAddress
FROM Sales.Customer ORDER BY LastName, FirstName');
while ($obj = sqlsrv_fetch_object($stmt, 'Customer')) {
    $obj->printData();
}
sqlsrv_free_stmt($stmt);

// Retrieving results by using the functions sqlsrv_fetch() and sqlsrv_get_field().
$stmt = sqlsrv_query($db, 'SELECT DISTINCT TOP(10) FirstName, LastName, EmailAddress
FROM Sales.Customer ORDER BY LastName, FirstName');
while (sqlsrv_fetch($stmt)) {
    printf("<li>%s %s %s</li>\n", sqlsrv_get_field($stmt, 0), sqlsrv_get_field($stmt, 1), sqlsrv_get_field($stmt, 2));
}
sqlsrv_free_stmt($stmt);