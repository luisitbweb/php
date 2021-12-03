<?php

try{
    $dbh = new PDO("sqlsrv:server=(local); Database=AdventureWorksLT2008",
            "sa", "\$tr@wb3rry");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Select products by name, list price, and category
    $query = "SELECT p.ProductID, p.Name AS ProducName , p.ListPrice, "
            . "pc.Name AS CategoryName "
            . "FROM SalesLT.Product AS p "
            . "JOIN SalesLT.ProductCategory AS pc "
            . "ON p.ProductCategoryID = pc.ProductCategoryID "
            . "ORDER BY p.Name";

    // Run query
    $stmt = $dbh->query($query);

    // Retrieve individual rows from the result
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    }

    // Release resources and close connection
    $stmt->closeCursor(); // alternatively, you could use $stmt = null;
    $dbh->close();
} catch (Exception $e) {
    die(print_r($e->getMessage()));
}