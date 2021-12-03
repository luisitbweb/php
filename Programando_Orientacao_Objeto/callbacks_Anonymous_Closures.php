<?php

class Product {

    public $name;
    public $price;

    function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

}

class ProcessSale {

    private $callbacks;

    function registerCallback($callback) {
        if (!is_callable($callback)) {
            throw new Exception("callback not callable");
        }
        $this->callbacks[] = $callback;
    }

    function sale($product) {
        print "{$product->name}: processing \n";
        foreach ($this->callbacks as $callback) {
            call_user_func($callback, $product);
        }
    }

}

class Mailer {

    function doMail($product) {
        print " mailing ({$product->name})<br />";
    }

}

$processor = new ProcessSale();
$processor->registerCallback(array(new Mailer(), "doMail"));
$processor->sale(new Product("shoes", 6));
print "\n";
$processor->sale(new Product("coffee", 6));

$logger = create_function('$product', 'print " logging ({$product->name})<br />";');
$processor = new ProcessSale();
$processor->registerCallback($logger);
$processor->sale(new Product("shoes", 6));
print "<br />";
$processor->sale(new Product("coffee", 6));

$logger2 = function( $product ) {
    print " logging ({$product->name})\n";
};
$processor = new ProcessSale();
$processor->registerCallback($logger2);
$processor->sale(new Product("shoes", 6));
print "<br />";
$processor->sale(new Product("coffee", 6));
