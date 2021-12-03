<?php

function __autoload($classe) {
    if (file_exists("Classes/{$classe}.class.php")) {
        include_once 'Classes/ShopProduct.class.php';
        include_once 'Classes/CdProduct.class.php';
    }
}

$product2 = new CdProduct('Exile on Coldharbour Lane ', 'The ', 'Alabama 3 ', 10.99, NULL, 60.33);
print "Artista: {$product2->getProducer()}<br />";
