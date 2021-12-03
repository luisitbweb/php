<?php

namespace www\PhpStudy\Integrating_PHP_Windows;
require './DatabaseConnection.php';
require './HTMLPage.php';

$html = new HTMLPage('AdventureWorks : Upload Product Photo');
$form = <<<'EOF'
        <form action="" enctype="multipart/form-data" method="post">
            ProductID: <input name="productID" /><br />
            File: <input type="file" name="productPhoto" /><br />
            <input type="submit" value="Upload" />
        </form><br />
EOF;
$html->addHTML($form);

if(isset($_POST['productID'])){
    // Connect to database
    $db = new DatabaseConnection();
    $db->connect();
    
    // Prepare query
    $query = 'UPDATE SalesLT.Product '
            . 'SET ThumbNailPhot = ?, ThumbinailPhotoFileName = ? '
            . 'WHERE ProductID = ?';
    $id = (int) $_POST['productID'];
    $filename = filter_var($_FILES['productPhoto']['name'], 
                                 FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    
    // Open file
    $file = fopen($_FILES['productPhoto']['tmp_name'], 'rb');
    
    // Set coding and data type
    $params = array(array($file, null, SQLSRV_PHPTYPE_STREAM(SQLSRV_ENC_BINARY),
                              SQLSRV_SQLTYPE_VARBINARY('MAX')), $filename, $id);
    
    $stmt = sqlsrv_query($db->handle, $query, $params);
    
    // Close file
    fclose($file);
    
    if($stmt === false){
        $db->exitWithError('Phote updoad failed.');
    }
    if(sqlsrv_rows_affected($stmt) != 1){
        $db->exitWithError('Did you specify the wrong ID?');
    }
    $html->addElement('p', 'Upload successful.');
    
    // Close database connection
    sqlsrv_free_stmt($stmt);
    $db->close();
}
$html->printPage();