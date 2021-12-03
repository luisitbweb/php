<?php
include_once './FruitStore.php';
include_once './CitrusStore.php';

class UseProducts{
    public function __construct() {
        $appleSauce = new FruitStore();
        $orangeJuice = new CitrusStore();
        $this->doInterface($appleSauce);
        $this->doInterface($orangeJuice);
    }
    // IProduct is type hint in dointerface
    
    function doInterface(IProduct $product){
        echo $product->apples();
        echo $product->oranges();
    }
}

$worker = new UseProducts();