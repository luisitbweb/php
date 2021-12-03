<?php

abstract class ShopProductWriter {

    protected $products = array();

    public function addProduct(ShopProduct $shopProduct) {
        $this->products[] = $shopProduct;
    }

    abstract public function write();
}

class XmlProductWriter extends ShopProductWriter {

    public function write() {
        $str = '<?xml version="1.0" encoding="UTF-8"?><br />';
        $str .= '<products><br />';
        foreach ($this->products as $shopProduct) {
            $str .= "\t<product title=\"{$shopProduct->getTitle()}\"><br />";
            $str .= "\t\t<sumary><br />";
            $str .= "\t\t{$shopProduct->getSummaryLine()}<br />";
            $str .= "\t\t</summary><br />";
            $str .= "\t</product><br />";
        }
        $str .= '</products><br />';
        print $str;
    }

}

class TextProductWriter extends ShopProductWriter {

    public function write() {
        $str = 'PRODUCTS: <BR />';
        foreach ($this->products as $shopProduct) {
            $str .= $shopProduct->getSummaryLine() . '<br />';
        }
        print $str;
    }

}
