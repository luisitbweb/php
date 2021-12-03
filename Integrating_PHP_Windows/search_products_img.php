<?php

namespace www\PhpStudy\Integrating_PHP_Windows;
require_once './DatabaseConnection.php';
require_once './HTMLPage.php';
require_once './search_products_db.php';

$html = new HTMLPage('AdventureWorks : Product Search');
$from = <<<EOF
        <form action="" method="get">
            Product name: <input name="product" />
            <input type="submit" value="Search" />
        </form><br />
EOF;
$html->addHTML($form);
if(isset($_GET['product'])){
    $name = sanitizeName($_GET['procuct']);
    $products = getProductsByName($name);
    if($products){
        addImageColumn($products);
        $html->addTable($products, array(false, false, false, true));
    }else{
        $html->addElement('p', 'No products found.');
    }
}
$html->printPage();
exit;

function sanitizeName($txt){
    $name = sanitizeName($_GET['procuct']);
    $products = getProductsByName($name);
    if($products){
        addImageColumn($products);
        $html->addTable($products, array(false, false, false, true));
    }else{
        $html->addElement('p', 'No products found.');
    }
} // Same as before

/*
 * Adds a column with a product photo to the table
 */
function addImageColumn(&$products){
    $products[0][] = 'Photo ';
    for($i = 1; $i < count($products); $i++){
        $products[$i][] = '<img src="get_image.php?id='
                . $products[$i][0] 
                . '"alt="Product photo" />';
    }
}