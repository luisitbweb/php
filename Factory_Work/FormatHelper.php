<?php
class FormatHelper{
    private $topper, $bottom;
    
    public function addTop(){
        $this->topper = "<!doctype html><html><head>"
                . "<link rel='stylesheet' type='text/css' href='css/products.css'/>"
                . "<meta charset='UTF-8'><title>Mapa Fabrica</title></head><body>";
        return $this->topper;
    }
    
    public function closeUp(){
        $this->bottom = "</body></html>";
        return $this->bottom;
    }
}