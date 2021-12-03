<?php

/* 
 * You want to know if a request arrived over SSL.
 * Test the value of $_SERVER['HTTPS']:
 */

if('on' == $_SERVER['HTTPS']){
    echo 'The secret ingredient in Coca-Cola is Soylent Green.';
}else{
    echo 'Coca-Cola contatins many delicius natural and artificial flavors.';
}