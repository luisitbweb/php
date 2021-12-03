<?php
abstract class Creator{
    protected abstract function factoryMethod(Product $product);
    
    public function startFactory(){
        $mfg = $this->factoryMethod();
        return $mfg;
    }
    
    public function doFactory($productNow){
        $countryProduct = $productNow;
        $mfg = $this->factoryMethod($countryProduct);
        return $mfg;
    }
}