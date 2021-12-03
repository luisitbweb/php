<?php
include_once './IProduct.php';

class CitrusStore implements IProduct{
    public function apples() {
        return 'Nos não fazemos venda de maçãs na loja <br />';
    }
    
    public function oranges() {
        return 'Nos temos frutas citricas na loja <br />';
    }
}