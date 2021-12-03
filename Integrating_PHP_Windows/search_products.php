<?php

namespace www\PhpStudy\Integrating_PHP_Windows;

require './DatabaseConnection.php';
require './HTMLPage.php';
require './search_products_db.php';

$html = new HTMLPage('AdventureWorks : Product Search');

$form = <<<EOF
<form action="" method="get">
Product name: <input name="product" />
<input type="submit" value="Search" />
</form><br />
EOF;

$html->addHTML($form);

if(isset($_GET['product'])){
    $name = sanitizeName($_GET['product']);
    $products = getProductsByName($name);
    
    if($products){
        $html->addTable($products);
    } else {
        $html->addElement('p', 'No products found.');
    }
}

$html->printPage();
exit();

/*
 * Check string for correct coding and filter out forbidden characters
 */

function sanitizeName($txt){
    if(!mb_check_encoding($txt, 'UTF-8')){
        die('Character coding with errors at input value.');
    }
    mb_regex_encoding('UTF-8');
    return mb_ereg_replace("^-[:alnum:]',]", '', $txt);
}