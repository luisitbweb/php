<?php
class AddressManger{
    private $addresses = ['209.131.36.156', '74.125.19.106'];
    
    function outputAddresses($resolve){
        foreach ($this->addresses as $address){
            print $address;
            if ($resolve){
                print  "(" . gethostbyaddr($address) . ")";
            }
            print "<br />";
        }
        return;
    }
}
$add = new AddressManger();
$add->outputAddresses();