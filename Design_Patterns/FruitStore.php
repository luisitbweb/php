<?php
include_once './IProduct.php';

class FruitStore implements IProduct{
    public function apples() {
        return 'Nos temos maçãs na loja <br />';
    }
    
    public function oranges() {
        return 'Nos não temos frutas citricas na loja <br />';
    }
}