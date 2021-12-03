<?php
include_once 'Product.php';

class GraphicProduct implements Product{
    private $mfgProduct;
    
    public function getProperties() {
        //$this->mfgProduct = "<!doctype html><html><head><meta charset='UTF-8' />";
        //$this->mfgProduct .= "<title>Mapa Fabrica</title>";
        //$this->mfgProduct .= "</head><body>";
        $this->mfgProduct .= "<img style='padding: 10px 10px 10px 0px'; src='imagens/background-fundo.jpg' align='left' alt='fundo' width='256' height='274' />";
        //$this->mfgProduct .= "</body></html>";
        return $this->mfgProduct;
    }
}