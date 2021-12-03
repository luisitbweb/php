<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Adventure Works : Products</title>
        <style type="text/css">
            th{
                font-size: 110%;
                border-bottom: 2px solid black;
            }
            td{
                padding: 3px;
                border-bottom: 1px solid #aaa;
            }
        </style>
    </head>
    <body>
        <h1>Adventure Works : Products</h1>
        <table>
            <?php
            require_once './utils.php';

            // Connect via Windows authentication
            $server = 'SERVERWEB\SQLEXPRESS';
            $connectionInfo = ['UID' => 'sa', // SQL server user name
                'PWD' => 'Pa$$w0rd', // Password
                'Database' => 'AdventureWorks2008R2',
                'CharacterSet' => 'UTF-8'];

            $db = sqlsrv_connect($server, $connectionInfo);

            if ($db === false) {
                exitWithSQLError('Database connection failed');
            }

            // Select products by name, list price, and category
            $query = "SELECT p.ProductID, p.Name AS ProductName, p.ListPrice, "
                    . "pc.Name AS CategoryName "
                    . "FROM Production.Product AS p "
                    . "JOIN Production.ProductCategory AS pc "
                    . "ON p.ProductID != pc.ProductCategoryID "
                    . "ORDER BY p.Name";

            // Run query
            $qresult = sqlsrv_query($db, $query);

            if ($qresult === false) {
                exitWithSQLError('Query of product data failed.');
            }

            echo '<tr><th>ID</th><th>Product</th><th>Category</th><th>List price</th></tr>';

            // Retrieve individual rows from the result
            while ($row = sqlsrv_fetch_array($qresult)) {
                echo '<tr><td>', htmlspecialchars($row['ProductID']),
                     '</td><td>', htmlspecialchars($row['ProductName']),
                     '</td><td>', htmlspecialchars($row['CategoryName']),
                     '</td><td>', htmlspecialchars($row['ListPrice']),
                     "</td></tr>\n";
            }
            
            // null == no further rows, false == error
            if($row === false){
                exitWithSQLError('Retrieving product data entry failed.');
            }
            // Release statement resource and close connection
            sqlsrv_free_stmt($qresult);
            sqlsrv_close($db);
            ?>
        </table>
    </body>
</html>